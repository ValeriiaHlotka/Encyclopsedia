<!DOCTYPE html>
<html>
<script src="https://aframe.io/releases/1.0.0/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
<body style="margin : 0px; overflow: hidden;">
<a-scene embedded arjs>
    <a-marker type="pattern" url="/entertainment/AR/markers/elephant.patt">
        <a-entity
                position="0 0 0"
                scale="1 1 1"
                gltf-model="/entertainment/AR/models/elephant.glb"
                rotation="0 45 45"
        >
            <a-animation attribute="rotation" begin="rotate" to="0 360 0"></a-animation>
        </a-entity>
    </a-marker>
    <a-entity camera></a-entity>
</a-scene>
</body>
</html>