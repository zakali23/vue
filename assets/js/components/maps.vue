<template>
    <div style="height: 600px; width: 100%">

        <l-map
                style="height: 100%; width: 100%"
                :zoom="zoom"
                :center="gps"
                @update:zoom="zoomUpdated"
                @update:center="centerUpdated"
                @update:bounds="boundsUpdated"
        >
            <l-tile-layer :url="url"></l-tile-layer>
            <l-marker :lat-lng="gps" ></l-marker>
        </l-map>
    </div>
</template>

<script>

    import { LMap, LTileLayer, LMarker } from 'vue2-leaflet';
    import  "leaflet/dist/leaflet.css";
    export default {
        components: {
            LMap,
            LTileLayer,
            LMarker,

        },
        props:{
            gps:Array
        },
        data() {
            return {
                url: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
                zoom: 13,
                center: [48.73,7.71],
                markerLatLng:[48.73,7.71],
                bounds: null
            }
        },
        methods: {
            zoomUpdated (zoom) {
                this.zoom = zoom;
            },
            centerUpdated (center) {
                this.center = center;
            },
            boundsUpdated (bounds) {
                this.bounds = bounds;
            }
        }
    }
</script>
<style scoped>
    .map {
        height: 300px;
        width: auto;

    }
</style>