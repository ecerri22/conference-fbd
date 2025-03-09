(function ($) {
    $.fn.mapmarker = function (options) {
        var opts = $.extend({}, $.fn.mapmarker.defaults, options);

        return this.each(function () {
            var mapElement = this;
            addMapMarker(mapElement, opts.zoom, opts.latLng, opts.markers);
        });
    };

    // Default settings for the map
    $.fn.mapmarker.defaults = {
        zoom: 14, 
        latLng: { lat: 41.122268778136544, lng: 20.08010636870987 }, 
        markers: {
            markers: [] 
        }
    };

    function addMapMarker(mapElement, zoom, latLng, markers) {
        // Map options
        var mapOptions = {
            zoom: zoom,
            center: new google.maps.LatLng(latLng.lat, latLng.lng),
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        // Create the map
        var map = new google.maps.Map(mapElement, mapOptions);

        // Loop through the markers array and add markers to the map
        markers.markers.forEach(function (theMarker) {
            var marker = new google.maps.Marker({
                map: map,
                position: new google.maps.LatLng(theMarker.latitude, theMarker.longitude),
                animation: google.maps.Animation.DROP,
                icon: theMarker.icon || null // Set the marker icon if provided
            });

            // Create an info window if balloon text is provided
            if (theMarker.baloon_text) {
                var infowindow = new google.maps.InfoWindow({
                    content: theMarker.baloon_text
                });

                // Open the info window on marker click
                marker.addListener("click", function () {
                    infowindow.open(map, marker);
                });
            }
        });
    }
})(jQuery);
