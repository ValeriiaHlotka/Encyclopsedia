<!DOCTYPE html>
<html>
<script src="https://aframe.io/releases/1.0.0/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
<body style="margin : 0px; overflow: hidden;">
<a-scene embedded arjs>
    <a-marker type="pattern" url="/entertainment/AR/markers/elephant.patt">
        <a-entity
            position="0 -0.5 0"
            scale="0.05 0.05 0.05"
            gltf-model="/entertainment/AR/models/elephant.glb"
            rotation="0 90 45"
        ></a-entity>
    </a-marker>
    <a-entity camera></a-entity>
</a-scene>
</body>
</html>