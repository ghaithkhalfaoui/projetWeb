import * as THREE from './build/three.module.js';
import { OrbitControls } from './jsm/controls/OrbitControls.js';
import { GLTFLoader } from './jsm/loaders/GLTFLoader.js';

// --- Setup ---
const scene = new THREE.Scene();
const canvas = document.querySelector('canvas.threejs');
const renderer = new THREE.WebGLRenderer({ canvas: canvas, antialias: true });
let camera, controls, model;

// --- Marker System ---
let markers = [];
const raycaster = new THREE.Raycaster();
const mouse = new THREE.Vector2();
let rotateSpeed = 0.08;
let tooltip; // Tooltip element




// --- Main Initialization ---
async function init() {
    renderer.setSize(window.innerWidth, window.innerHeight);
    renderer.setPixelRatio(window.devicePixelRatio);

    camera = new THREE.PerspectiveCamera(
        75,
        window.innerWidth / window.innerHeight,
        0.1,
        5000
    );
    camera.position.set(0, 0, 900);

    // --- Lighting ---
    const directionalLight = new THREE.DirectionalLight(0xffffff, 1.5);
    directionalLight.position.set(5, 10, 7.5);
    scene.add(directionalLight);
    scene.add(new THREE.AmbientLight(0xffffff, 0.75));

    // --- Orbit Controls ---
    controls = new OrbitControls(camera, canvas);
    controls.enableDamping = true;

    // --- Load model ---
    await loadWorld();

    // --- Load markers from database ---
    await loadMarkersFromDB();

    // --- Clicking markers ---
    window.addEventListener('click', onClickMarker);

    // --- Arrow keys for camera ---
    setupArrowKeyRotation();

    // --- Create Tooltip ---
    createTooltip();

    // --- Mouse Move for Hover ---
    window.addEventListener('mousemove', onMouseMove);

    renderloop();
}

// --- Load 3D world model ---
async function loadWorld() {
    try {
        const modelResponse = await fetch('../getModle.php');
        const modelData = await modelResponse.json();

        const loader = new GLTFLoader();

        const gltf = await new Promise((resolve, reject) =>
            loader.load(modelData.path, resolve, undefined, reject)
        );

        model = gltf.scene;
        scene.add(model);

    } catch (error) {
        console.error("Error loading world data:", error);
    }
}

// =======================================================
//               LOAD MARKERS FROM DATABASE
// =======================================================
// --- Helper: Create Pin Marker ---
function createPinMarker(color = 0xff0000) {
    const group = new THREE.Group();

    // Cone (the point)
    const coneGeom = new THREE.ConeGeometry(2, 8, 16);
    const coneMat = new THREE.MeshStandardMaterial({ color: color });
    const cone = new THREE.Mesh(coneGeom, coneMat);
    // Tip at 0,0,0. Center of cone (height 8) is at y=0 by default? No, usually center of geometry is at (0,0,0).
    // So tip is at y=4. Base is at y=-4.
    // We want tip at 0. So shift up by 4.
    cone.position.y = 4;
    group.add(cone);

    // Sphere (the head)
    const sphereGeom = new THREE.SphereGeometry(3, 16, 16);
    const sphereMat = new THREE.MeshStandardMaterial({ color: color });
    const sphere = new THREE.Mesh(sphereGeom, sphereMat);
    sphere.position.y = 8; // Top of cone
    group.add(sphere);

    return group;
}

async function loadMarkersFromDB() {
    try {
        const response = await fetch("../getMarker.php");
        const data = await response.json();

        if (!Array.isArray(data)) {
            console.error("Markers data is not an array:", data);
            return;
        }

        data.forEach(entry => {
            const pin = createPinMarker(0xff0000);

            pin.position.set(entry.x, entry.y, entry.z);
            pin.position.set(entry.x, entry.y, entry.z);
            // Store data on the group (pin)
            pin.userData.name = entry.name;
            pin.userData.idPost = entry.idPost;

            // Also store on children so raycaster hits propagate info if needed, 
            // OR we fix the click handler to look at parent. 
            // Let's store on group, and fix click handler.

            scene.add(pin);

            markers.push({ mesh: pin, position: entry });
        });

        console.log("Loaded markers from DB:", markers);

    } catch (e) {
        console.error("Could not load markers from DB:", e);
    }
}

// =======================================================
//               PICKING (Occlusion + Tolerance)
// =======================================================
function getIntersectedMarker(event) {
    if (markers.length === 0) return null;

    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);

    // 1. Get occlusion distance from globe
    let occlusionDistance = Infinity;
    if (model) {
        const globeIntersects = raycaster.intersectObject(model, true);
        if (globeIntersects.length > 0) {
            occlusionDistance = globeIntersects[0].distance;
        }
    }

    // 2. Find markers within tolerance AND in front of globe
    const ray = raycaster.ray;
    let candidates = [];
    const tolerance = 25; // World units tolerance? Original code checked dist < 25.
    // NOTE: ray.distanceToPoint returns world unit distance. 
    // If the scene is large (camera z=900), 25 is reasonable.

    markers.forEach(m => {
        const markerPos = m.mesh.position;
        // Perpendicular distance to the ray line
        const perpDist = ray.distanceToPoint(markerPos);

        if (perpDist < tolerance) {
            // Distance along the ray from camera to projection of point
            // We can approximate with distanceTo(camera) or clearer:
            const distToCam = camera.position.distanceTo(markerPos);

            if (distToCam < occlusionDistance) {
                candidates.push({
                    marker: m.mesh,
                    dist: distToCam
                });
            }
        }
    });

    // 3. Sort by distance to camera to find the closest one
    if (candidates.length > 0) {
        candidates.sort((a, b) => a.dist - b.dist);
        return candidates[0].marker;
    }

    return null;
}

function onClickMarker(event) {
    const target = getIntersectedMarker(event);
    if (target) {
        // Target is the group (Pin), so we can access userData directly
        alert("ID: " + target.userData.idPost + "\nName: " + target.userData.name);
    }
}

// =======================================================
//               TOOLTIP & HOVER
// =======================================================
function createTooltip() {
    tooltip = document.createElement('div');
    tooltip.id = 'marker-tooltip';
    document.body.appendChild(tooltip);
}

function onMouseMove(event) {
    const target = getIntersectedMarker(event);

    if (target) {
        tooltip.style.display = 'block';
        tooltip.style.left = (event.clientX + 10) + 'px';
        tooltip.style.top = (event.clientY + 10) + 'px';
        tooltip.innerText = target.userData.name;
        document.body.style.cursor = 'pointer';
    } else {
        hideTooltip();
    }
}

function hideTooltip() {
    if (tooltip) tooltip.style.display = 'none';
    document.body.style.cursor = 'default';
}

// =======================================================
//                 ARROW KEY ROTATION
// =======================================================
function setupArrowKeyRotation() {
    const spherical = new THREE.Spherical();
    const offset = new THREE.Vector3();

    window.addEventListener('keydown', (e) => {
        const active = document.activeElement;
        if (active && (active.tagName === 'INPUT' || active.tagName === 'TEXTAREA')) return;

        offset.copy(camera.position).sub(controls.target);
        spherical.setFromVector3(offset);

        switch (e.key) {
            case "ArrowLeft":
                spherical.theta -= rotateSpeed;
                break;
            case "ArrowRight":
                spherical.theta += rotateSpeed;
                break;
            case "ArrowUp":
                spherical.phi -= rotateSpeed;
                break;
            case "ArrowDown":
                spherical.phi += rotateSpeed;
                break;
            default:
                return;
        }

        spherical.makeSafe();
        offset.setFromSpherical(spherical);
        camera.position.copy(controls.target).add(offset);
        camera.lookAt(controls.target);

        controls.update();
    });
}

// --- Resize Handler ---
window.addEventListener('resize', () => {
    camera.aspect = window.innerWidth / window.innerHeight;
    camera.updateProjectionMatrix();
    renderer.setSize(window.innerWidth, window.innerHeight);
});

// --- Render Loop ---
const renderloop = () => {
    controls.update();
    renderer.render(scene, camera);
    requestAnimationFrame(renderloop);
};

init();
