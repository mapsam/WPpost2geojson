function init() {

	// build geoJSON
	var geoJson = {};
	geoJson['type'] = 'FeatureCollection';
	geoJson['features'] = [];
	groups = [];

	for (i=0; i<group.length; i++) {
		var newFeature = {
			"type": "Feature",
			"geometry": {
				"type": "Point",
				"coordinates": [lons[i], lats[i]]
			},
			"properties": {
				"group_name": group[i]
			}
		}
		geoJson['features'].push(newFeature);	
	}

	// use geoJSON to make the map
	var map = L.mapbox.map('map', 'examples.map-9ijuk24y')
    	.setView([46.673016, -122.355797], 7)
 		.featureLayer.setGeoJSON(geoJson);

}

window.onLoad = init();