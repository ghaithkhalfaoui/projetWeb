import * as THREE from './build/three.module.js';
import { OrbitControls } from './jsm/controls/OrbitControls.js';
import { GLTFLoader } from './jsm/loaders/GLTFLoader.js';
import TWEEN from './jsm/libs/tween.module.js';

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
    // Initial position
    camera.position.set(0, 0, 900);

    // --- Lighting ---
    const directionalLight = new THREE.DirectionalLight(0xffffff, 1.5);
    directionalLight.position.set(5, 10, 7.5);
    scene.add(directionalLight);
    scene.add(new THREE.AmbientLight(0xffffff, 0.75));

    // --- Orbit Controls ---
    controls = new OrbitControls(camera, canvas);
    controls.enableDamping = true;
    controls.dampingFactor = 0.05;

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

    // --- Search Functionality ---
    setupSearch();

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


//----------------------------LOAD MARKERS FROM DATABASE

// --- Create Pin Marker
function createPinMarker(color = 0xff0000) {
    const group = new THREE.Group();

    // Cone 
    const coneGeom = new THREE.ConeGeometry(2, 8, 16);
    const coneMat = new THREE.MeshStandardMaterial({ color: color });
    const cone = new THREE.Mesh(coneGeom, coneMat);
 
    cone.position.y = 4;
    group.add(cone);

    // Sphere (the head)
    const sphereGeom = new THREE.SphereGeometry(3, 16, 16);
    const sphereMat = new THREE.MeshStandardMaterial({ color: color });
    const sphere = new THREE.Mesh(sphereGeom, sphereMat);
    sphere.position.y = 8; 
    group.add(sphere);

    return group;
}

async function loadMarkersFromDB() {
    try {
        const response = await fetch("../getMarker.php");
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        let data;
        const text = await response.text();
        try {
            data = JSON.parse(text);
        } catch (err) {
            console.error("INVALID JSON:", text);
            return;
        }

        if (!Array.isArray(data)) {
            console.error("Markers data is not an array:", data);
            return;
        }

        data.forEach(entry => {
            const pin = createPinMarker(0xff0000);

            pin.position.set(entry.x, entry.y, entry.z);

            // Store data
            pin.userData.name = entry.name;
            pin.userData.idPost = entry.idPost;



            scene.add(pin);


            markers.push({
                mesh: pin,
                position: new THREE.Vector3(entry.x, entry.y, entry.z),
                data: entry
            });
        });

        console.log("Loaded markers from DB:", markers);

    } catch (e) {
        console.error("Could not load markers from DB:", e);
    }
}


//--------------------RAYCASTING FOR MARKERS
function getIntersectedMarker(event) {
    if (markers.length === 0) return null;

    mouse.x = (event.clientX / window.innerWidth) * 2 - 1;
    mouse.y = -(event.clientY / window.innerHeight) * 2 + 1;

    raycaster.setFromCamera(mouse, camera);


    let occlusionDistance = Infinity;
    if (model) {
        const globeIntersects = raycaster.intersectObject(model, true);
        if (globeIntersects.length > 0) {
            occlusionDistance = globeIntersects[0].distance;
        }
    }


    const ray = raycaster.ray;
    let candidates = [];
    const tolerance = 25; 


    markers.forEach(m => {
        const markerPos = m.mesh.position;
      
        const perpDist = ray.distanceToPoint(markerPos);

        if (perpDist < tolerance) {
            
            const distToCam = camera.position.distanceTo(markerPos);

            if (distToCam < occlusionDistance) {
                candidates.push({
                    marker: m.mesh,
                    dist: distToCam
                });
            }
        }
    });

    
    if (candidates.length > 0) {
        candidates.sort((a, b) => a.dist - b.dist);
        return candidates[0].marker;
    }

    return null;
}

function onClickMarker(event) {
    const target = getIntersectedMarker(event);
    if (target) {
        
        alert("ID: " + target.userData.idPost + "\nName: " + target.userData.name);
    }
}


//--------------TOOLTIP & HOVER

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


//--------------------SEARCH FUNCTIONALITY

function setupSearch() {
    const searchInput = document.getElementById('country-search');
    if (!searchInput) return;

    searchInput.addEventListener('keydown', (e) => {
        if (e.key === 'Enter') {
            const query = searchInput.value.trim().toLowerCase();
            if (!query) return;

            const found = markers.find(m => m.data.name.toLowerCase() === query);

            if (found) {
                focusOnMarker(found);
                searchInput.value = '';
                searchInput.blur();
            } else {
               
                alert("Country not found in markers list.");
            }
        }
    });
}

function focusOnMarker(markerObj) {
    const targetPos = markerObj.position;

   
    const currentDist = camera.position.length();

    
    const newPos = targetPos.clone().normalize().multiplyScalar(currentDist);

    // Animate Camera Position
    new TWEEN.Tween(camera.position)
        .to({ x: newPos.x, y: newPos.y, z: newPos.z }, 1500)
        .easing(TWEEN.Easing.Cubic.InOut)
        .onUpdate(() => {
            camera.lookAt(0, 0, 0); 
        })
        .start();

    
    new TWEEN.Tween(controls.target)
        .to({ x: 0, y: 0, z: 0 }, 1500)
        .easing(TWEEN.Easing.Cubic.InOut)
        .start();
}


//---------------ARROW KEY ROTATION

function setupArrowKeyRotation() {
    const spherical = new THREE.Spherical();
    const offset = new THREE.Vector3();

    window.addEventListener('keydown', (e) => {
        const active = document.activeElement;
        // Don't rotate if typing in search
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
    requestAnimationFrame(renderloop);
    TWEEN.update(); 
    controls.update();
    renderer.render(scene, camera);
};

init();
