<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Dashboard</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="card">
            <div class="container">
                <div class="card-body">
                    <div id="googleMap" style="width:100%;height:542px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    var marker;    

    function buatMarker(peta, posisiTitik) {
        //membuat marker
        marker = new google.maps.Marker({
            position: posisiTitik,
            map: peta
        });
    }

    function initialize() {
        var propertiPeta = {
            center: new google.maps.LatLng(-7.797068, 110.370529),
            zoom: 12,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };

        var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);

        <?php
        foreach ($toko as $tk) {
            $latitude = $tk->latitude;
            $longitude = $tk->longitude;
            ?>

            var lokasi = new google.maps.LatLng(<?php echo $latitude."," ?> <?php echo $longitude ?>);
            buatMarker(peta, lokasi);

        <?php } ?>

        //event ketika peta diklik
        google.maps.event.addListener(peta, 'click', function(event) {
            taruhMarker(this, event.latLng);
        });
    }

    // event jendela di-load  
    google.maps.event.addDomListener(window, 'load', initialize);
</script>