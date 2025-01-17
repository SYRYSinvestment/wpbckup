var G5Plus_Nearby_Places = G5Plus_Nearby_Places || {};
(function ($) {
	"use strict";
	G5Plus_Nearby_Places = function (element) {
		this.$element = $(element);
		this.element = element;
		this.$element_map = this.$element.find('.near-location-map');
		this.$element_detail = this.$element.find('.nearby-places-detail');
		this.options = this.$element.data('options');
		this.init();
	};


	G5Plus_Nearby_Places.prototype.init = function () {
		var location = new google.maps.LatLng(this.options.lat, this.options.lng);
		this.infowindow = new google.maps.InfoWindow();


		this.map = new google.maps.Map(this.$element_map[0], {
			center: location,
			zoom: 8,
			icon: this.options.marker,
			scrollwheel: false,
			fullscreenControl: true
		});

		this.bounds = new google.maps.LatLngBounds();

		var marker = new google.maps.Marker({
			position: location,
			icon: this.options.marker
		});

		marker.setMap(this.map);

		var request = '';
		if (this.options.rank_by === 'distance') {
			request = {
				location: location,
				type: this.options.places,
				rankBy: google.maps.places.RankBy.DISTANCE
			};
		} else {
			request = {
				location: location,
				radius: this.options.radius,
				type: this.options.places
			};
		}

		var service = new google.maps.places.PlacesService(this.map);
		var _self = this;

		service.nearbySearch(request, function (results, status) {
			_self.search_callback(results, status);
		});


	};

	G5Plus_Nearby_Places.prototype.search_callback = function (results, status) {
		var _self = this;
		if (status === google.maps.places.PlacesServiceStatus.OK) {
			for (var i = 0; i < results.length; i++) {
				this.create_marker(results[i]);
			}
			this.scroll();
		} else {
			this.$element_detail.append('<p>No result!</p>');
		}
	};

	G5Plus_Nearby_Places.prototype.create_marker = function(place) {
		var _self = this;
		var place_type = '';
		$.each(place.types,function (k,v) {
			if ($.inArray(v,_self.options.places) !== -1) {
				place_type = v;
			}
		});


		if (place_type !== '') {
			this.options.places = $.grep(this.options.places, function (value) {
				return value !== place_type;
			});



			var distance = this.distance(place.geometry.location.lat(), place.geometry.location.lng());
			var place_detail = this.options.places_detail[place_type];
			this.$element_detail.append("<div class='near-location-info'><ul><li class='right'>" + place_detail.label + "</li><li class='left'><span>" + distance + " " + this.options.distance_in + "</span></li></ul><span>" + place.name + "</span></div>");
			var marker = new google.maps.Marker({
				map: this.map,
				position: place.geometry.location,
				icon: place_detail.icon
			});

			this.bounds.extend(marker.position);

			this.map.fitBounds(this.bounds);

			google.maps.event.addListener(marker, 'click', function () {
				_self.infowindow.setContent('<strong>' + place_detail.label + '</strong>' + '</br>' + place.name);
				_self.infowindow.open(_self.map, this);
			});
		}
	};

	G5Plus_Nearby_Places.prototype.distance = function(latitude, longitude) {
		var lat1 = this.options.lat;
		var lng1 = this.options.lng;
		var lat2 = latitude;
		var lng2 = longitude;
		var radlat1 = Math.PI * lat1 / 180;
		var radlat2 = Math.PI * lat2 / 180;
		var theta = lng1 - lng2;
		var radtheta = Math.PI * theta / 180;
		var dist = Math.sin(radlat1) * Math.sin(radlat2) + Math.cos(radlat1) * Math.cos(radlat2) * Math.cos(radtheta);
		dist = Math.acos(dist);
		dist = dist * 180 / Math.PI;
		dist = dist * 60 * 1.1515;
		if (this.options.distance_in === "km") {
			dist = dist * 1.609344;
		} else if (this.options.distance_in === "m") {
			dist = dist * 1.609344 * 1000;
		}
		return Math.round(dist * 100) / 100;
	};

	G5Plus_Nearby_Places.prototype.scroll = function() {
		var detail_height = this.$element_detail.height(),
			map_height = this.$element_map.height();
		if (detail_height >= map_height) {
			this.$element_detail.css('position', 'relative');
			this.$element_detail.css('max-height', + map_height);
			this.$element_detail.css('overflow-y', 'scroll');
			this.$element_detail.css('overflow-x', 'hidden');
			this.$element_detail.perfectScrollbar({
				wheelSpeed: 0.5,
				suppressScrollX: true
			});
		}
	};

	$(document).ready(function () {
		if (!$('body').hasClass('elementor-editor-active')) {
			typeof (google) !== 'undefined' && google.maps.event.addDomListener(window, 'load', function () {
				$('.g5plus-nearby-places').each(function () {
					new G5Plus_Nearby_Places(this);
				});
				$(document).trigger("maps:loaded");
			});
		}
	});

})(jQuery);