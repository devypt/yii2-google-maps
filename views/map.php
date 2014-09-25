<div style="width: <?= $this->context->width ?>px;height: <?= $this->context->height ?>px">
    <div id="map_canvas" style="width:100%; height:100%"></div>
</div>
<script>
    var geocoder, map;

    function initialize() {

        var mapOptions = {
            zoom: <?= $this->context->zoom ?>,
            mapTypeId: google.maps.MapTypeId.<?= $this->context->mapType ?>,
            center: false
        };
<?php if (is_array($this->context->center)): ?>
            mapOptions['center'] = new google.maps.LatLng(<?= $this->context->center[0] ?>, <?= $this->context->center[1] ?>);
<?php else: ?>
            geocoder = new google.maps.Geocoder();
            geocoder.geocode({
                "address": "<?= $this->context->center ?>"
            }, function (results, status) {
                alert(results);
                if (status === google.maps.GeocoderStatus.OK) {
                    mapOptions['center'] = results[0].geometry.location;
                } else {
                    mapOptions['center'] = new google.maps.LatLng(0, 0);
                }

            }

            );
<?php endif; ?>
        alert(mapOptions['center']);

        map = new google.maps.Map(document.getElementById("map_canvas"), mapOptions);

//        var marker = new google.maps.Marker({
//            map: map,
//            position: results[0].geometry.location
//        });
    }
    function loadScript() {
        var script = document.createElement("script");
        script.type = "text/javascript";
        script.src = "https://maps.googleapis.com/maps/api/js?key=<?= $this->context->apiKey ?>&sensor=<?= $this->context->sensor ?>&callback=initialize";
        document.body.appendChild(script);
    }

    window.onload = loadScript;
</script>

