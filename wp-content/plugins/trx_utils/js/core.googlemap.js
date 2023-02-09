function diveit_googlemap_init(dom_obj, coords) {
	"use strict";

	if (typeof DIVEIT_STORAGE['googlemap_init_obj'] == 'undefined') diveit_googlemap_init_styles();
	DIVEIT_STORAGE['googlemap_init_obj'].geocoder = '';
	try {
		var id = dom_obj.id;
		DIVEIT_STORAGE['googlemap_init_obj'][id] = {
			dom: dom_obj,
			markers: coords.markers,
			geocoder_request: false,
			opt: {
				zoom: coords.zoom,
				center: null,
				scrollwheel: false,
				scaleControl: false,
				disableDefaultUI: false,
				panControl: true,
				zoomControl: true, //zoom
				mapTypeControl: false,
				streetViewControl: false,
				overviewMapControl: false,
				styles: DIVEIT_STORAGE['googlemap_styles'][coords.style ? coords.style : 'default'],
				mapTypeId: google.maps.MapTypeId.ROADMAP
			}
		};
        if (typeof diveit_googlemap_create=="undefined") {

            return;
        }
		diveit_googlemap_create(id);

	} catch (e) {
		
		//dcl(DIVEIT_STORAGE['strings']['googlemap_not_avail']);

	};
}

function diveit_googlemap_create(id) {

    if (typeof DIVEIT_STORAGE['googlemap_init_obj'] == 'undefined')
	// Create map
	DIVEIT_STORAGE['googlemap_init_obj'][id].map = new google.maps.Map(DIVEIT_STORAGE['googlemap_init_obj'][id].dom, DIVEIT_STORAGE['googlemap_init_obj'][id].opt);

	// Add markers
	for (var i in DIVEIT_STORAGE['googlemap_init_obj'][id].markers)
		DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].inited = false;
	diveit_googlemap_add_markers(id);
	
	// Add resize listener
	jQuery(window).resize(function() {
		if (DIVEIT_STORAGE['googlemap_init_obj'][id].map)
			DIVEIT_STORAGE['googlemap_init_obj'][id].map.setCenter(DIVEIT_STORAGE['googlemap_init_obj'][id].opt.center);
	});
}

function diveit_googlemap_add_markers(id) {
	"use strict";
	for (var i in DIVEIT_STORAGE['googlemap_init_obj'][id].markers) {
		
		if (DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].inited) continue;
		
		if (DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].latlng == '') {
			
			if (DIVEIT_STORAGE['googlemap_init_obj'][id].geocoder_request!==false) continue;
			
			if (DIVEIT_STORAGE['googlemap_init_obj'].geocoder == '') DIVEIT_STORAGE['googlemap_init_obj'].geocoder = new google.maps.Geocoder();
			DIVEIT_STORAGE['googlemap_init_obj'][id].geocoder_request = i;
			DIVEIT_STORAGE['googlemap_init_obj'].geocoder.geocode({address: DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].address}, function(results, status) {
				"use strict";
				if (status == google.maps.GeocoderStatus.OK) {
					var idx = DIVEIT_STORAGE['googlemap_init_obj'][id].geocoder_request;
					if (results[0].geometry.location.lat && results[0].geometry.location.lng) {
						DIVEIT_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = '' + results[0].geometry.location.lat() + ',' + results[0].geometry.location.lng();
					} else {
						DIVEIT_STORAGE['googlemap_init_obj'][id].markers[idx].latlng = results[0].geometry.location.toString().replace(/\(\)/g, '');
					}
					DIVEIT_STORAGE['googlemap_init_obj'][id].geocoder_request = false;
					setTimeout(function() { 
						diveit_googlemap_add_markers(id); 
						}, 200);
				} else
					dcl(DIVEIT_STORAGE['strings']['geocode_error'] + ' ' + status);
			});
		
		} else {
			
			// Prepare marker object
			var latlngStr = DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].latlng.split(',');
			var markerInit = {
				map: DIVEIT_STORAGE['googlemap_init_obj'][id].map,
				position: new google.maps.LatLng(latlngStr[0], latlngStr[1]),
				clickable: DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].description!=''
			};
			if (DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].point) markerInit.icon = DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].point;
			if (DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].title) markerInit.title = DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].title;
			DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].marker = new google.maps.Marker(markerInit);
			
			// Set Map center
			if (DIVEIT_STORAGE['googlemap_init_obj'][id].opt.center == null) {
				DIVEIT_STORAGE['googlemap_init_obj'][id].opt.center = markerInit.position;
				DIVEIT_STORAGE['googlemap_init_obj'][id].map.setCenter(DIVEIT_STORAGE['googlemap_init_obj'][id].opt.center);				
			}
			
			// Add description window
			if (DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].description!='') {
				DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].infowindow = new google.maps.InfoWindow({
					content: DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].description
				});
				google.maps.event.addListener(DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].marker, "click", function(e) {
					var latlng = e.latLng.toString().replace("(", '').replace(")", "").replace(" ", "");
					for (var i in DIVEIT_STORAGE['googlemap_init_obj'][id].markers) {
						if (latlng == DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].latlng) {
							DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].infowindow.open(
								DIVEIT_STORAGE['googlemap_init_obj'][id].map,
								DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].marker
							);
							break;
						}
					}
				});
			}
			
			DIVEIT_STORAGE['googlemap_init_obj'][id].markers[i].inited = true;
		}
	}
}

function diveit_googlemap_refresh(id) {
	"use strict";
	for (id in DIVEIT_STORAGE['googlemap_init_obj']) {
		diveit_googlemap_create(id);
	}
}

function diveit_googlemap_init_styles() {
	"use strict";
	// Init Google map
	DIVEIT_STORAGE['googlemap_init_obj'] = {};
	DIVEIT_STORAGE['googlemap_styles'] = {
		'default': []
	};
	if (window.diveit_theme_googlemap_styles!==undefined)
		DIVEIT_STORAGE['googlemap_styles'] = diveit_theme_googlemap_styles(DIVEIT_STORAGE['googlemap_styles']);
}