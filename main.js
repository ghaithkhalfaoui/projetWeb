import * as THREE from './build/three.module.js';
import { OrbitControls } from './jsm/controls/OrbitControls.js';
import { GLTFLoader } from './jsm/loaders/GLTFLoader.js';

//scene
const scene = new THREE.Scene();
//camera 
const camera = new THREE.PerspectiveCamera(
    75,
    window.innerWidth / window.innerHeight,
    0.1,
    1000
);
camera.position.z = 900;
//load model
fetch('../getModle.php')
    .then(res => res.json())
    .then(data => {
        const loader = new GLTFLoader();

        loader.load(data.path, gltf => {
            const model = gltf.scene;

            //model.position.set(data.x, data.y, 0);
            scene.add(model);
        });
    })
//light
const light = new THREE.DirectionalLight(0xffffff, 1);
light.position.set(5,10,7.5);
scene.add(light);
//init canvas
const canvas = document.querySelector('canvas.threejs');
const renderer = new THREE.WebGLRenderer({canvas: canvas});
renderer.setSize(window.innerWidth,window.innerHeight);

//init controls
const controls = new OrbitControls(camera,canvas);
controls.enableDamping = true;
controls.autoRotate = true;

const renderloop = () =>{
  controls.update();
  renderer.render(scene,camera);
  window.requestAnimationFrame(renderloop);
}
renderloop();