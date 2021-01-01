<section id="content">
	<div class="row">
		<div class="span8">
			<div id="googleMap" class="span10" style="width:100%;height:600px;"></div>
		</div>

		<div class="span4">
			<div class="span4 control-group">
				<label>Toko Pertama*</label>
				<select name="inp_toko_a" id="inp_toko_a" class="span4" required>
					<option value="0">---Pilih Toko---</option>
					<?php foreach ($toko as $tk) : ?>
						<option value="<?php echo $tk->alamat_toko ?>"><?php echo $tk->nama_toko ?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('inp_toko_a', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="span4 control-group">
				<label>Toko Kedua*</label>
				<select name="inp_toko_b" id="inp_toko_b" class="span4" required>
					<option value="0">---Pilih Toko---</option>
					<?php foreach ($toko as $tk) : ?>
						<option value="<?php echo $tk->alamat_toko ?>"><?php echo $tk->nama_toko ?></option>
					<?php endforeach; ?>
				</select>
				<?php echo form_error('inp_toko_b', '<small class="text-danger">', '</small>') ?>
			</div>
			<div class="span4 control-group">
				<button class="btn btn-primary btn" onclick="calcRoute()">Hitung</button>
			</div>
			<div class="span4 control-group">
				<div class="row controls" id="hasildata">

				</div>
			</div>
		</div>

	</div>
</section>
<script>
	function hitung_jarak() {
		navigator.geolocation.getCurrentPosition(function(position) {
			var origin1 = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			// var origin1 = new google.maps.LatLng();
			var destinationA = document.getElementById('inp_toko_a').value;
			var destinationB = document.getElementById('inp_toko_b').value;

			var service = new google.maps.DistanceMatrixService();
			service.getDistanceMatrix({
				origins: [origin1],
				destinations: [destinationA, destinationB],
				travelMode: 'DRIVING',
				travelMode: google.maps.TravelMode.DRIVING,
				unitSystem: google.maps.UnitSystem.IMPERIAL,
				avoidHighways: false,
				avoidTolls: false
			}, callback);
		});
	}

	function callback(response, status) {
		if (status == 'OK') {
			var origins = response.originAddresses;
			var destinations = response.destinationAddresses;

			for (var i = 0; i < origins.length; i++) {
				var results = response.rows[i].elements;
				for (var j = 0; j < results.length; j++) {
					var element = results[j];
					var distance = element.distance.text;
					var duration = element.duration.text;
					var from = origins[i];
					var to = destinations[j];
					if (i == 0) {
						$("#hasildata").append("<div class='span2 control-group'> Dari : " + from + "<br><br> Tujuan : " + to + "<br><br> Durasi : " + duration + "<br><br> Distance : " + distance + "</div>");
					}
				}
			}
		}
	}
</script>
<script>
	var directionsDisplay;
	var directionsService = new google.maps.DirectionsService();
	// var directionsRenderer = new google.maps.DirectionsRenderer();

	function addMarker(peta, InfoWindow, info) {
		//membuat marker
		var infoWindow = new google.maps.InfoWindow();
		var marker = new google.maps.Marker({
			position: InfoWindow,
			map: peta
		});

		bindInfoWindow(marker, peta, infoWindow, info);
	}

	function calculateAndDisplayRoute(marker, peta, directionsService, directionsDisplay) {
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var asal = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
				var tujuan = new google.maps.LatLng(marker.getPosition().lat(), marker.getPosition().lng())
				directionsService.route({
						origin: asal,
						destination: tujuan,
						travelMode: 'DRIVING'
					},

					function(response, status) {
						if (status === 'OK') {
							directionsDisplay.setDirections(response);
						} else {
							window.alert('Directions request failed due to ' + status);
						}

					});
			});

		} else {
			alert('Gagal');
		}
	}

	function calcRoute() {
		navigator.geolocation.getCurrentPosition(function(position) {
			var start = {
				lat: position.coords.latitude,
				lng: position.coords.longitude
			};
			// var start = new google.maps.LatLng();
			var end = document.getElementById('inp_toko_a').value;
			var end2 = document.getElementById('inp_toko_b').value;
			// var tujuan = [start, end, end2];

			console.log(start);
			console.log(end);
			console.log(end2);

			var waypoints = [];
			waypoints.push({
				location: start,
				stopover: true
			});
			var request = {
				origin: end,
				destination: end2,
				waypoints: waypoints, //an array of waypoints
				optimizeWaypoints: true,
				travelMode: google.maps.TravelMode.DRIVING
			};
			directionsService.route(request, function(response, status) {
				if (status == google.maps.DirectionsStatus.OK) {
					directionsDisplay.setDirections(response);
				}
			});
			hitung_jarak();
		});
	}

	function initialize() {
		var bounds = new google.maps.LatLngBounds();
		var propertiPeta = {
			center: new google.maps.LatLng(-7.797068, 110.370529),
			zoom: 13,
			myTypeId: google.maps.MapTypeId.ROADMAP
		};

		var infoWindow = new google.maps.InfoWindow();


		var peta = new google.maps.Map(document.getElementById("googleMap"), propertiPeta);
		<?php
		foreach ($toko as $tk) :
			$id_toko = $tk->id_toko;
			$nama_toko = $tk->nama_toko;
			$alamat_toko = $tk->alamat_toko;
			$latitude = $tk->latitude;
			$longitude = $tk->longitude;
		?>

			var contentString<?php echo $id_toko; ?> = '<div id="content">' +
				'<div id="siteNotice">' +
				'</div>' +
				'<h3 id="firstHeading" class="firstHeading">' + "<?php echo $nama_toko; ?>" + '</h3>' +
				'<div id="bodyContent">' +
				'<p><b>' + "<?php echo $alamat_toko; ?>" + '</b></p>' +
				'<h5><a href=' + "<?php echo site_url('Member/Member_toko/detail_toko/' . $id_toko) ?>" + '>' +
				'Detail</a></h5>' +
				'</div>' +
				'</div>';

			var infowindow<?php echo $id_toko; ?> = new google.maps.InfoWindow({
				content: contentString<?php echo $id_toko; ?>
			});

			var marker<?php echo $id_toko; ?> = new google.maps.Marker({
				position: {
					lat: <?php echo $latitude; ?>,
					lng: <?php echo $longitude; ?>
				},
				map: peta,
				title: String(<?php echo $id_toko; ?>)
			});

			marker<?php echo $id_toko; ?>.addListener('click', function() {
				infowindow<?php echo $id_toko; ?>.open(peta, marker<?php echo $id_toko; ?>);
			});
		<?php endforeach; ?>

		// Try HTML5 geolocation.
		if (navigator.geolocation) {
			navigator.geolocation.getCurrentPosition(function(position) {
				var pos = {
					lat: position.coords.latitude,
					lng: position.coords.longitude
				};

				var tujuan = {
					lat: -7.7521102,
					lng: 110.3275516
				};

				var lingkaran = new google.maps.Circle({
					strokeColor: '#7FFFD4',
					strokeOpacity: 0.8,
					strokeWeight: 2,
					fillColor: '#7FFFD4',
					fillOpacity: 0.35,
					map: peta,
					center: pos,
					radius: 4000 //dalam meter
				});

				var rendererOptions = {
					map: peta
				}
				directionsDisplay = new google.maps.DirectionsRenderer(rendererOptions)

				infoWindow.setPosition(pos);
				infoWindow.setContent('Your Location.');
				infoWindow.open(peta);
				peta.setCenter(pos);
			}, function() {
				handleLocationError(true, infoWindow, peta.getCenter());
			});
		} else {
			// Browser doesn't support Geolocation
			handleLocationError(false, infoWindow, peta.getCenter());
		}
	}

	//event jendela diload
	var jendela = new google.maps.event.addDomListener(window, 'load', initialize);

	function bindInfoWindow(marker, map, infoWindow, html) {

		var directionsService = new google.maps.DirectionsService;

		var directionsDisplay = new google.maps.DirectionsRenderer;
		directionsDisplay.setPanel(null);
		directionsDisplay.setMap(map);
		google.maps.event.addListener(marker, 'click', function() {
			//infoWindow.setContent('tes');
			// console.log(marker.getPosition().lat());            
			// calculateAndDisplayRoute(marker, map, directionsService, directionsDisplay);
			//infoWindow.open(map, marker);            
		});
	}
</script>