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
	var map = L.mapbox.map('map', 'examples.map-9ijuk24y');
    var featureLayer = L.mapbox.featureLayer(geoJson)
	    .addTo(map);
	map.fitBounds(featureLayer.getBounds());

	// add button
	$('#add-button').click(function(){
		$('#add').toggleClass('do-it');
		$(this).toggleClass('do-it');
	});
	$('#close-add').click(function(){
		$('#add').toggleClass('do-it');
		$('#add-button').toggleClass('do-it');
	});

}

window.onLoad = init();

