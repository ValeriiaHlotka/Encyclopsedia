<!--<script src="https://aframe.io/releases/0.9.2/aframe.min.js"></script>
<script src="https://raw.githack.com/jeromeetienne/AR.js/2.0.5/aframe/build/aframe-ar.js"></script>

<body style='margin : 0px; overflow: scroll;'>
    <a-scene embedded arjs>
    <a-box position='0 0.5 0' material='opacity: 0.5;'></a-box>
    <a-marker-camera preset='hiro'></a-marker-camera>
</a-scene>
</body>-->

<!--<script src="https://aframe.io/releases/1.0.0/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script>
<body style="margin : 0px; overflow: hidden;">

<a-scene embedded arjs>
    <a-marker preset="hiro">
        <a-entity
                position="0 -1 0"
                scale="0.05 0.05 0.05"
                gltf-model="https://arjs-cors-proxy.herokuapp.com/https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/scene.gltf">
        </a-entity>
    </a-marker>
    <a-entity camera></a-entity>
</a-scene>
</body>-->



<!--<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1c2407b26c61958baa93967b5412487cd94b290b/dist/aframe-master.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>

<style>
    .arjs-loader {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .arjs-loader div {
        text-align: center;
        font-size: 1.25em;
        color: white;
    }
</style>

<body style="margin : 0px; overflow: hidden;">
<div class="arjs-loader">
    <div>Loading, please wait...</div>
</div>
<a-scene
        vr-mode-ui="enabled: false;"
        renderer="logarithmicDepthBuffer: true;"
        embedded
        arjs="trackingMethod: best; sourceType: webcam;debugUIEnabled: false;"
>

    <a-nft
            type="nft"
            url="/https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/trex-image/trex"
            smooth="true"
            smoothCount="10"
            smoothTolerance=".01"
            smoothThreshold="5"
    >
        <a-entity
                gltf-model="/https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/scene.gltf"
                scale="5 5 5"
                position="50 150 0"
        >
        </a-entity>
    </a-nft>
    <a-entity camera></a-entity>
</a-scene>
</body>-->
<!--<script type="module" src="https://unpkg.com/@google/model-viewer/dist/model-viewer.min.js"></script>
<model-viewer src="https://modelviewer.dev/shared-assets/models/Astronaut.glb"
              ios-src="https://modelviewer.dev/shared-assets/models/Astronaut.usdz"
              alt="A 3D model of an astronaut"
              ar ar-scale="fixed"
              ar-modes="webxr"
              auto-rotate
              camera-controls
              xr-environment></model-viewer>-->
<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1c2407b26c61958baa93967b5412487cd94b290b/dist/aframe-master.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>

<style>
    .arjs-loader {
        height: 100%;
        width: 100%;
        position: absolute;
        top: 0;
        left: 0;
        background-color: rgba(0, 0, 0, 0.8);
        z-index: 9999;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .arjs-loader div {
        text-align: center;
        font-size: 1.25em;
        color: white;
    }
</style>

<body style="margin : 0px; overflow: hidden;">
<!-- minimal loader shown until image descriptors are loaded -->
<div class="arjs-loader">
    <div>Loading, please wait...</div>
</div>
<a-scene
        vr-mode-ui="enabled: false;"
        renderer="logarithmicDepthBuffer: true;"
        embedded
        arjs="trackingMethod: best; sourceType: webcam;debugUIEnabled: false;"
>
    <!-- we use cors proxy to avoid cross-origin problems ATTENTION! you need to set up your server -->
    <a-nft
            type="nft"
            url="https://encyclopsedia.azurewebsites.net/https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/trex-image/trex"
            smooth="true"
            smoothCount="10"
            smoothTolerance=".01"
            smoothThreshold="5"
    >
        <a-entity
                gltf-model="https://encyclopsedia.azurewebsites.net/https://raw.githack.com/AR-js-org/AR.js/master/aframe/examples/image-tracking/nft/trex/scene.gltf"
                scale="5 5 5"
                position="50 150 0"
        >
        </a-entity>
    </a-nft>
    <a-entity camera></a-entity>
</a-scene>
</body>
