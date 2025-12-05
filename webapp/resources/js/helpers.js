// Description: Helper functions to process the data and configurations.

export default {
    /**
     * Add a WMS layer for the nautical chart.
     * @param {maplibregl.Map} map - The MapLibre GL map instance.
     */
    addWmsLayer(map) {
        // remove layer if already exists
        if (map.getLayer("wms-nautical-chart")) {
            map.removeLayer("wms-nautical-chart");
        }
        // remove source if already exists
        if (map.getSource("wms-nautical-chart")) {
            map.removeSource("wms-nautical-chart");
        }

        map.addSource("wms-nautical-chart", {
            type: "raster",
            tiles: [
                "https://enc.hidrografico.pt/?CSVALUE=,,,,,3&CSBOOL=2183&service=WMS&request=GetMap&styles=&transparent=false&version=1.3.0&layers=ENC,IENC&format=image/png&crs=EPSG:3857&bbox={bbox-epsg-3857}&width=256&height=256",
            ],
            tileSize: 256,
        });
        map.addLayer({
            id: "wms-nautical-chart",
            type: "raster",
            source: "wms-nautical-chart",
            layout: { visibility: "none" },
        });
    },

    /**
     * Add annotations layer from GeoJSON.
     * @param {maplibregl.Map} map - The MapLibre GL map instance.
     * @param {Object} annotationsGeojson - GeoJSON data for annotations.
     */
    addAnnotationsLayer(map, annotationsGeojson) {
        if (map.getLayer("annotations")) {
            map.removeLayer("annotations");
        }
        if (map.getLayer("annotations-text")) {
            map.removeLayer("annotations-text");
        }
        if (map.getSource("annotations")) {
            map.removeSource("annotations");
        }

        map.addSource("annotations", {
            type: "geojson",
            data: annotationsGeojson,
        });
        map.addLayer({
            id: "annotations",
            type: "fill",
            source: "annotations",
            paint: { "fill-color": "#088", "fill-opacity": 0.2 },
        });
        map.addLayer({
            id: "annotations-text",
            type: "symbol",
            source: "annotations",
            layout: {
                "text-field": ["get", "notes"],
                "text-font": ["Open Sans Bold", "Arial Unicode MS Bold"],
                "text-size": ["get", "size"],
                "text-rotate": ["get", "rotate"],
                "text-allow-overlap": true,
                "text-ignore-placement": true,
                "text-anchor": "center",
                "text-pitch-alignment": "map",
                "text-rotation-alignment": "map",
            },
            paint: {
                "text-color": "#000",
                "text-halo-color": "#fff",
                "text-halo-width": 1,
            },
        });
    },

    /**
     * Add no-go areas layer from GeoJSON.
     * @param {maplibregl.Map} map - The MapLibre GL map instance.
     * @param {Object} nogoareasGeojson - GeoJSON data for no-go areas.
     */
    addNoGoAreasLayer(map, nogoareasGeojson) {
        if (map.getLayer("no-go-areas")) {
            map.removeLayer("no-go-areas");
        }
        if (map.getSource("no-go-areas")) {
            map.removeSource("no-go-areas");
        }

        map.addSource("no-go-areas", {
            type: "geojson",
            data: nogoareasGeojson,
        });
        map.addLayer({
            id: "no-go-areas",
            type: "fill",
            source: "no-go-areas",
            paint: { "fill-color": "#f00", "fill-opacity": 0.2 },
        });
    },

    /**
     * Add zones layer from GeoJSON.
     * @param {maplibregl.Map} map - The MapLibre GL map instance.
     * @param {Object} zonesGeojson - GeoJSON data for zones.
     */
    addZonesLayer(map, zonesGeojson) {
        if (map.getLayer("zones")) {
            map.removeLayer("zones");
        }

        if (map.getSource("zones")) {
            map.removeSource("zones");
        }

        map.addSource("zones", { type: "geojson", data: zonesGeojson });
        map.addLayer({
            id: "zones",
            type: "fill",
            source: "zones",
            paint: {
                "fill-color": "#f2c580",
                "fill-opacity": 0.9,
                "fill-outline-color": "#FFF",
            },
        });
    },

    /**
     * Add mooring bitts layer from GeoJSON.
     * @param {maplibregl.Map} map - The MapLibre GL map instance.
     * @param {Object} mooringBittsGeojson - GeoJSON data for mooring bitts.
     */
    addMooringBittsLayer(map, mooringBittsGeojson) {
        if (map.getLayer("mooring-bitts")) {
            map.removeLayer("mooring-bitts");
        }

        if (map.getSource("mooring-bitts")) {
            map.removeSource("mooring-bitts");
        }

        map.addSource("mooring-bitts", {
            type: "geojson",
            data: mooringBittsGeojson,
        });
        map.addLayer({
            id: "mooring-bitts",
            type: "symbol",
            source: "mooring-bitts",
            layout: {
                "text-field": ["get", "code"],
                "text-font": ["Open Sans Bold", "Arial Unicode MS Bold"],
                "text-offset": [0, 0],
                "text-size": 8,
            },
            paint: {
                "text-color": "black",
                "text-halo-color": "white",
                "text-halo-width": 1,
            },
        });
    },

    /**
     * Get the draw styles for Mapbox Draw.
     * These styles define how drawn features (points, lines, polygons) are displayed on the map.
     * @returns {Array} - An array of style configurations for Mapbox Draw.
     */
    getMapDrawStyles() {
        return [
            // Highlight active points (points being actively edited)
            {
                id: "highlight-active-points",
                type: "circle",
                filter: [
                    "all",
                    ["==", "$type", "Point"],
                    ["==", "meta", "feature"],
                    ["==", "active", "true"],
                ],
                paint: {
                    "circle-radius": 0, // No radius for the circle
                    "circle-stroke-color": "#FFF", // White stroke
                    "circle-stroke-width": 2, // Stroke width
                    "circle-color": "#C62828", // Red fill color
                },
            },
            // Inactive points (points not being edited)
            {
                id: "points-are-blue",
                type: "circle",
                filter: [
                    "all",
                    ["==", "$type", "Point"],
                    ["==", "meta", "feature"],
                    ["==", "active", "false"],
                ],
                paint: {
                    "circle-radius": 0, // No radius for the circle
                    "circle-color": "#C62828", // Red fill color
                },
            },
            // Line styles for active lines (lines being actively edited)
            {
                id: "gl-draw-line",
                type: "line",
                filter: [
                    "all",
                    ["==", "$type", "LineString"],
                    ["!=", "mode", "static"],
                ],
                layout: {
                    "line-cap": "round", // Rounded line caps
                    "line-join": "round", // Rounded line joins
                    "line-round-limit": 2, // Round limit
                },
                paint: {
                    "line-dasharray": [0.2, 2], // Dash array
                    "line-color": "#000000", // Red line color
                    "line-width": 3, // Line width
                },
            },
            // Polygon fill for active polygons (polygons being actively edited)
            {
                id: "gl-draw-polygon-fill",
                type: "fill",
                filter: [
                    "all",
                    ["==", "$type", "Polygon"],
                    ["!=", "mode", "static"],
                ],
                paint: {
                    "fill-color": "#C62828", // Red fill color
                    "fill-outline-color": "#C62828", // Red outline color
                    "fill-opacity": 0.1, // Fill opacity
                },
            },
            // Midpoints of polygon edges (active editing)
            {
                id: "gl-draw-polygon-midpoint",
                type: "circle",
                filter: [
                    "all",
                    ["==", "$type", "Point"],
                    ["==", "meta", "midpoint"],
                ],
                paint: {
                    "circle-radius": 0, // No radius for the circle
                    "circle-stroke-color": "#FFF", // White stroke
                    "circle-stroke-width": 0, // No stroke width
                    "circle-color": "#C62828", // Red fill color
                },
            },
            // Polygon outline stroke for active polygons
            {
                id: "gl-draw-polygon-stroke-active",
                type: "line",
                filter: [
                    "all",
                    ["==", "$type", "Polygon"],
                    ["!=", "mode", "static"],
                ],
                layout: {
                    "line-cap": "round", // Rounded line caps
                    "line-join": "round", // Rounded line joins
                },
                paint: {
                    "line-color": "#C62828", // Red line color
                    "line-width": 5, // Line width
                },
            },
            // Vertex halos for active polygons and lines
            {
                id: "gl-draw-polygon-and-line-vertex-halo-active",
                type: "circle",
                filter: [
                    "all",
                    ["==", "meta", "vertex"],
                    ["==", "$type", "Point"],
                    ["!=", "mode", "static"],
                ],
                paint: {
                    "circle-radius": 0, // No radius for the circle
                    "circle-stroke-color": "#FFF", // White stroke
                    "circle-stroke-width": 2, // Stroke width
                    "circle-color": "#C62828", // Red fill color
                },
            },
            // Vertex points for active polygons and lines
            {
                id: "gl-draw-polygon-and-line-vertex-active",
                type: "circle",
                filter: [
                    "all",
                    ["==", "meta", "vertex"],
                    ["==", "$type", "Point"],
                    ["!=", "mode", "static"],
                ],
                paint: {
                    "circle-radius": 0, // No radius for the circle
                    "circle-stroke-color": "#FFF", // White stroke
                    "circle-stroke-width": 2, // Stroke width
                    "circle-color": "#C62828", // Red fill color
                },
            },

            // INACTIVE (static, already drawn)
            // Line styles for static (already drawn) lines
            {
                id: "gl-draw-line-static",
                type: "line",
                filter: [
                    "all",
                    ["==", "$type", "LineString"],
                    ["==", "mode", "static"],
                ],
                layout: {
                    "line-cap": "round", // Rounded line caps
                    "line-join": "round", // Rounded line joins
                },
                paint: {
                    "line-color": "#000", // Black line color
                    "line-width": 5, // Line width
                },
            },
            // Polygon fill for static polygons
            {
                id: "gl-draw-polygon-fill-static",
                type: "fill",
                filter: [
                    "all",
                    ["==", "$type", "Polygon"],
                    ["==", "mode", "static"],
                ],
                paint: {
                    "fill-color": "#000", // Black fill color
                    "fill-outline-color": "#000", // Black outline color
                    "fill-opacity": 0.1, // Fill opacity
                },
            },
            // Polygon outline for static polygons
            {
                id: "gl-draw-polygon-stroke-static",
                type: "line",
                filter: [
                    "all",
                    ["==", "$type", "Polygon"],
                    ["==", "mode", "static"],
                ],
                layout: {
                    "line-cap": "round", // Rounded line caps
                    "line-join": "round", // Rounded line joins
                },
                paint: {
                    "line-color": "#000", // Black line color
                    "line-width": 5, // Line width
                },
            },
        ];
    },
};
