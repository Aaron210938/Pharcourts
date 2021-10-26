<!DOCTYPE html>
<html>

<head>
    <title>Address Selection</title>
    <style>
        body {
            margin: 0;
        }

        .sb-title {
            position: relative;
            top: -12px;
            font-family: Roboto, sans-serif;
            font-weight: 500;
        }

        .sb-title-icon {
            position: relative;
            top: -5px;
        }

        .card-container {
            display: flex;
            height: 500px;
            width: 600px;
        }

        .panel {
            background: white;
            width: 300px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-around;
        }

        .half-input-container {
            display: flex;
            justify-content: space-between;
        }

        .half-input {
            max-width: 120px;
        }

        .map {
            width: 300px;
        }

        h2 {
            margin: 0;
            font-family: Roboto, sans-serif;
        }

        input {
            height: 30px;
        }

        input {
            border: 0;
            border-bottom: 1px solid black;
            font-size: 14px;
            font-family: Roboto, sans-serif;
            font-style: normal;
            font-weight: normal;
        }

        input:focus::placeholder {
            color: white;
        }
    </style>
    <script>
        "use strict";

        function initMap() {
            const componentForm = [
                'location',
                'locality',
                'administrative_area_level_1',
                'country',
                'postal_code',
            ];
            const map = new google.maps.Map(document.getElementById("map"), {
                zoom: 11,
                center: {
                    lat: 37.4221,
                    lng: -122.0841
                },
                mapTypeControl: false,
                fullscreenControl: true,
                zoomControl: true,
                streetViewControl: true
            });
            const marker = new google.maps.Marker({
                map: map,
                draggable: false
            });
            const autocompleteInput = document.getElementById('location');
            const autocomplete = new google.maps.places.Autocomplete(autocompleteInput);
            autocomplete.addListener('place_changed', function() {
                marker.setVisible(false);
                const place = autocomplete.getPlace();
                if (!place.geometry) {
                    // User entered the name of a Place that was not suggested and
                    // pressed the Enter key, or the Place Details request failed.
                    window.alert('No details available for input: \'' + place.name + '\'');
                    return;
                }
                renderAddress(place);
                fillInAddress(place);
            });

            function fillInAddress(place) { // optional parameter
                const addressNameFormat = {
                    'street_number': 'short_name',
                    'route': 'long_name',
                    'locality': 'long_name',
                    'administrative_area_level_1': 'short_name',
                    'country': 'long_name',
                    'postal_code': 'short_name',
                };
                const getAddressComp = function(type) {
                    for (const component of place.address_components) {
                        if (component.types[0] === type) {
                            return component[addressNameFormat[type]];
                        }
                    }
                    return '';
                };
                document.getElementById('location').value = getAddressComp('street_number') + ' ' +
                    getAddressComp('route');
                for (const component of componentForm) {
                    // Location field is handled separately above as it has different logic.
                    if (component !== 'location') {
                        document.getElementById(component).value = getAddressComp(component);
                    }
                }
            }

            function renderAddress(place) {
                map.setCenter(place.geometry.location);
                marker.setPosition(place.geometry.location);
                marker.setVisible(true);
            }
        }
    </script>
</head>

<body>
    <div class="card-container">
        <div class="panel">
            <div>
                <img class="sb-title-icon" src="https://fonts.gstatic.com/s/i/googlematerialicons/location_pin/v5/24px.svg" alt="">
                <span class="sb-title">Address Selection</span>
            </div>
            <input type="text" placeholder="Address" id="location" />
            <input type="text" placeholder="Apt, Suite, etc (optional)" />
            <input type="text" placeholder="City" id="locality" />
            <div class="half-input-container">
                <input type="text" class="half-input" placeholder="State/Province" id="administrative_area_level_1" />
                <input type="text" class="half-input" placeholder="Zip/Postal code" id="postal_code" />
            </div>
            <input type="text" placeholder="Country" id="country" />
        </div>
        <div class="map" id="map"></div>
    </div>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhqitsfJytTHjwNtcDUcQ-06uVTRcTKdk&libraries=places&callback=initMap&channel=GMPSB_addressselection_v1_cAB" async defer></script>
</body>

</html>