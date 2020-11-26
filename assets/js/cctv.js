//THREEJS RELATED VARIABLES 

var scene,
    camera,
    controls,
    fieldOfView,
    aspectRatio,
    nearPlane,
    farPlane,
    shadowLight,
    backLight,
    light,
    renderer,
    lensFlare,
    container;

//SCENE
var floor, CCTV, pointer,
    isBlowing = false;

//SCREEN VARIABLES

var HEIGHT,
    WIDTH,
    windowHalfX,
    windowHalfY,
    mousePos = { x: 0, y: 0 };
dist = 0;

function init() {
    scene = new THREE.Scene();

    HEIGHT = window.innerHeight;
    WIDTH = window.innerWidth;
    aspectRatio = WIDTH / HEIGHT;
    fieldOfView = 60;
    nearPlane = 1;
    farPlane = 2000;
    camera = new THREE.PerspectiveCamera(
        fieldOfView,
        aspectRatio,
        nearPlane,
        farPlane);
    camera.position.z = 800;
    camera.position.y = 0;
    camera.lookAt(new THREE.Vector3(0, 0, 0));
    renderer = new THREE.WebGLRenderer({ alpha: true, antialias: true });
    renderer.setSize(WIDTH, HEIGHT);
    renderer.shadowMapEnabled = true;
    container = document.getElementById('world');
    container.appendChild(renderer.domElement);
    windowHalfX = WIDTH / 2;
    windowHalfY = HEIGHT / 2;
    window.addEventListener('resize', onWindowResize, false);
    document.addEventListener('mousemove', handleMouseMove, false);
    document.addEventListener('mousedown', handleMouseDown, false);
    document.addEventListener('mouseup', handleMouseUp, false);
    document.addEventListener('touchstart', handleTouchStart, false);
    document.addEventListener('touchend', handleTouchEnd, false);
    document.addEventListener('touchmove', handleTouchMove, false);

}

function onWindowResize() {
    HEIGHT = window.innerHeight;
    WIDTH = window.innerWidth;
    windowHalfX = WIDTH / 2;
    windowHalfY = HEIGHT / 2;
    renderer.setSize(WIDTH, HEIGHT);
    camera.aspect = WIDTH / HEIGHT;
    camera.updateProjectionMatrix();
}

function handleMouseMove(event) {
    mousePos = { x: event.clientX, y: event.clientY };
}

function handleMouseDown(event) {
    isBlowing = true;
}
function handleMouseUp(event) {
    isBlowing = false;
}

function handleTouchStart(event) {
    if (event.touches.length > 1) {
        event.preventDefault();
        mousePos = { x: event.touches[0].pageX, y: event.touches[0].pageY };
        isBlowing = true;
    }
}

function handleTouchEnd(event) {
    mousePos = { x: windowHalfX, y: windowHalfY };
    isBlowing = false;
}

function handleTouchMove(event) {
    if (event.touches.length == 1) {
        event.preventDefault();
        mousePos = { x: event.touches[0].pageX, y: event.touches[0].pageY };
    }
}

function createLights() {
    light = new THREE.HemisphereLight(0xffffff, 0xffffff, .5)

    shadowLight = new THREE.DirectionalLight(0xffffff, .8);
    shadowLight.position.set(200, 200, 200);
    shadowLight.castShadow = true;
    shadowLight.shadowDarkness = .2;

    backLight = new THREE.DirectionalLight(0xffffff, .4);
    backLight.position.set(-100, 200, 50);
    backLight.shadowDarkness = .1;
    backLight.castShadow = true;

    scene.add(backLight);
    scene.add(light);
    scene.add(shadowLight);
}
function createPointer() {
    pointer = new Pointer();
    pointer.threegroup.position.z = 350;
    scene.add(pointer.threegroup);
}


function createCCTV() {
    CCTV = new CCTV();
    scene.add(CCTV.threegroup);
}

CCTV = function () {

    this.bodyInitPositions = [];
    this.maneParts = [];
    this.threegroup = new THREE.Group();
    this.grey1Mat = new THREE.MeshLambertMaterial({
        color: 0x989898,
        shading: THREE.FlatShading
    });
    this.greyMat = new THREE.MeshLambertMaterial({
        color: 0x585858,
        shading: THREE.FlatShading
    });
    this.blackMat = new THREE.MeshPhongMaterial({
        color: 0x202020,
        shading: THREE.FlatShading

    });

    this.whiteMat = new THREE.MeshPhongMaterial({
        color: 0xFFFFFF,
        shininess: 80,
        specular: 0x555555,
        shading: THREE.FlatShading

    });
    this.redMat = new THREE.MeshLambertMaterial({
        color: 0xFF0000,
        shading: THREE.FlatShading

    });

    var bodyGeom = new THREE.CylinderGeometry(30, 80, 140, 4);
    var faceGeom = new THREE.BoxGeometry(120, 120, 250);
    var lens1Geom = new THREE.TorusGeometry(40, 10, 0, 62)
    var lens2Geom = new THREE.CylinderGeometry(39, 39, 40, 14)
    var hood1Geom = new THREE.BoxGeometry(150, 15, 295)
    var hood2Geom = new THREE.BoxGeometry(10, 110, 300)
    var hood3Geom = new THREE.BoxGeometry(10, 110, 300)
    var littlelightGeom = new THREE.BoxGeometry(15, 15, 15)

    // body
    this.body = new THREE.Mesh(bodyGeom, this.whiteMat);
    this.body.position.z = 0;
    this.body.position.y = -100;
    this.bodyVertices = [0, 1, 2, 3, 4, 10];

    for (var i = 0; i < this.bodyVertices.length; i++) {
        var tv = this.body.geometry.vertices[this.bodyVertices[i]];
        tv.z = 70;
        //tv.x = 0;
        this.bodyInitPositions.push({ x: tv.x, y: tv.y, z: tv.z });
    }
    // face
    this.face = new THREE.Mesh(faceGeom, this.grey1Mat);
    this.face.position.z = 0;

    // LENS?
    this.lens1 = new THREE.Mesh(lens1Geom, this.greyMat);
    this.lens1.position.z = 130;
    this.lens1.position.y = 0;
    this.lens1.rotation.x = 0;

    this.lens2 = new THREE.Mesh(lens2Geom, this.blackMat);
    this.lens2.position.z = 119;
    this.lens2.position.y = 0;
    this.lens2.rotation.x = 1.6;

    this.hood1 = new THREE.Mesh(hood1Geom, this.whiteMat);
    this.hood1.position.z = 20;
    this.hood1.position.y = 70;
    this.hood1.verticesNeedUpdate = true;
    hood2Geom.vertices[7].z = 80;
    hood2Geom.vertices[2].z = 80;
    hood3Geom.vertices[7].z = 80;
    hood3Geom.vertices[2].z = 80;
    this.hood2 = new THREE.Mesh(hood2Geom, this.whiteMat);
    this.hood2.position.z = 19;
    this.hood2.position.y = 10;
    this.hood2.position.x = -70

    this.hood3 = new THREE.Mesh(hood3Geom, this.whiteMat);
    this.hood3.position.z = 19;
    this.hood3.position.y = 10;
    this.hood3.position.x = 70;

    this.littlelight = new THREE.Mesh(littlelightGeom, this.redMat);
    this.littlelight.position.y = -40;
    this.littlelight.position.x = 40;
    this.littlelight.position.z = 120;
    //ANOTHER THING

    //another thing

    // head
    this.head = new THREE.Group();
    this.head.add(this.face);
    this.head.add(this.lens1);
    this.head.add(this.lens2);
    this.head.add(this.hood1);
    this.head.add(this.hood2);
    this.head.add(this.hood3);
    this.head.add(this.littlelight);
    this.head.position.y = -200;
    this.head.position.z = 0;
    this.head.scale = 10
    this.threegroup.add(this.head);

    this.threegroup.traverse(function (object) {
        if (object instanceof THREE.Mesh) {
            object.castShadow = true;
            object.receiveShadow = true;
        }
    });
}

CCTV.prototype.updateBody = function (speed) {

    this.head.rotation.y += (this.tHeagRotY - this.head.rotation.y) / speed;
    this.head.rotation.x += (this.tHeadRotX - this.head.rotation.x) / speed;
    this.head.position.x += (this.tHeadPosX - this.head.position.x) / speed;
    this.head.position.y += (this.tHeadPosY - this.head.position.y) / speed;
    this.head.position.z += (this.tHeadPosZ - this.head.position.z) / speed;
    this.head.scale.y += (this.tHeadYScale - this.head.scale.y) / speed;
    //this.head.scale.y += (this.tHeadScale - this.Head.scale.y) / (speed*2);
    this.head.scale.x += (this.tHeadXScale - this.head.scale.x) / speed;
}

CCTV.prototype.look = function (xTarget, yTarget) {
    this.tHeagRotY = rule3(xTarget, -200, 200, -Math.PI / 4, Math.PI / 4);
    this.tHeadRotX = rule3(yTarget, -200, 200, -Math.PI / 4, Math.PI / 4);
    this.tHeadPosX = 0;
    this.tHeadPosY = 0;
    this.tHeadPosZ = 0;

    this.tHeadYScale = 1;
    this.tHeadXScale = 1;

    this.updateBody(10);




    for (var i = 0; i < this.bodyVertices.length; i++) {
        var tvInit = this.bodyInitPositions[i];
        var tv = this.body.geometry.vertices[this.bodyVertices[i]];
        tv.x = tvInit.x + this.head.position.x;
    }
    this.body.geometry.verticesNeedUpdate = true;
}

CCTV.prototype.cool = function (xTarget, yTarget) {
    this.tHeagRotY = rule3(xTarget, -200, 200, Math.PI / 4, -Math.PI / 4);
    this.tHeadRotX = rule3(yTarget, -200, 200, Math.PI / 4, -Math.PI / 4);
    this.tHeadPosX = 0;
    this.tHeadPosY = 0;
    this.tHeadPosZ = 0;
    this.tHeadYScale = 1;
    this.tHeadXScale = 1;

    this.updateBody(10);



    for (var i = 0; i < this.bodyVertices.length; i++) {
        var tvInit = this.bodyInitPositions[i];
        var tv = this.body.geometry.vertices[this.bodyVertices[i]];
        tv.x = tvInit.x + this.head.position.x;
    }
    this.body.geometry.verticesNeedUpdate = true;
}
Pointer = function () {
    this.isBlowing = false;
    this.speed = 0;
    this.acc = 0;



    this.threegroup = new THREE.Group();
    this.threegroup.add(this.core);

}

Pointer.prototype.update = function (xTarget, yTarget) {
    this.threegroup.lookAt(new THREE.Vector3(0, 80, 60));
    this.tPosX = rule3(xTarget, -200, 200, -250, 250);
    this.tPosY = rule3(yTarget, -200, 200, 250, -250);

    this.threegroup.position.x += (this.tPosX - this.threegroup.position.x) / 10;
    this.threegroup.position.y += (this.tPosY - this.threegroup.position.y) / 10;


    this.targetSpeed = (this.isBlowing) ? .3 : .01;
    if (this.isBlowing && this.speed < .5) {
        this.acc += .001;
        this.speed += this.acc;
    } else if (!this.isBlowing) {
        this.acc = 0;
        this.speed *= .98;
    }

}


function loop() {
    render();
    var xTarget = (mousePos.x - windowHalfX);
    var yTarget = (mousePos.y - windowHalfY);

    pointer.isBlowing = isBlowing;
    pointer.update(xTarget, yTarget);
    if (isBlowing) {
        CCTV.look(xTarget, yTarget);
    } else {

        CCTV.look(xTarget, yTarget);
    }
    requestAnimationFrame(loop);
}

function render() {
    if (controls) controls.update();
    renderer.render(scene, camera);
}


init();
createLights();
createCCTV();
createPointer();
loop();



function clamp(v, min, max) {
    return Math.min(Math.max(v, min), max);
}

function rule3(v, vmin, vmax, tmin, tmax) {
    var nv = Math.max(Math.min(v, vmax), vmin);
    var dv = vmax - vmin;
    var pc = (nv - vmin) / dv;
    var dt = tmax - tmin;
    var tv = tmin + (pc * dt);
    return tv;

}