<!--<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<model-viewer src="https://modelviewer.dev/shared-assets/models/Astronaut.glb"
              ios-src="https://modelviewer.dev/shared-assets/models/Astronaut.usdz"
              alt="A 3D model of an astronaut"
              ar ar-scale="fixed"
              ar-modes="webxr"
              auto-rotate
              camera-controls
              xr-environment></model-viewer>
"https://arjs-cors-proxy.herokuapp.com/https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/scene.gltf"-->

<!DOCTYPE html>
<html>
<script src="https://aframe.io/releases/1.0.0/aframe.min.js"></script>
<!-- we import arjs version without NFT but with marker + location based support -->
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
<body style="margin : 0px; overflow: hidden;">
<a-scene embedded arjs>
    <a-marker type="pattern" url="entertainment/AR/markers/ball.patt">
        <!-- we use cors proxy to avoid cross-origin problems ATTENTION! you need to set up your server -->
        <a-entity
                position="0 -1 0"
                scale="0.05 0.05 0.05"
                gltf-model="entertainment/AR/models/fox.fbx"
                rotation="0 90 45"
        ></a-entity>
    </a-marker>
    <a-entity camera></a-entity>
</a-scene>
</body>
</html>