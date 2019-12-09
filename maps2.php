<?php
	$i=0;
	$j=0;
	$result = "";
	$result2 = "";
	$lines = array();
	$lines2 = array();
	$lines = @file("data.txt") or $result = "파일을 읽을 수 없습니다.";
	$lines2 = @file("location.txt") or $result = "파일을 읽을 수 없습니다.";

	if ($lines != null){
		for($i = 0;$i < count($lines);$i++){
			$result .= ($i + 1) . ": " . $lines[$i] . "<br>";
		}
	}

	if ($lines2 != null){
		for($j = 0;$j < count($lines2);$j++){
			$result2 .= ($j + 1) . ": " . $lines2[$j] . "<br>";
		}
	}
	$abc = count($lines);
?>
<!DOCTYPE html>

<html>
 <head>
   <title>Google Maps Example</title>
   <script src="https://cdn.pubnub.com/sdk/javascript/pubnub.4.19.0.min.js"></script>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" />
 </head>
		<body>
			<div class="container">
			 <div id="map-canvas" style="width:900px;height:500px"></div>
		   </div>
		<p><?php echo $result; ?></p>
		<p><?php echo $lines[2]; ?></p>
	<script>

	   var map;
	   var mark;
	   var mark2;
	   var markerArray = [];
	   var marker_cou = <?= $abc ?>;
	   var i=0;
	   var lat1 = <?= json_encode($lines) ?>;
	   var lat2 = <?= json_encode($lines2) ?>;
	   var qoduf = new Array();
	   var count=0;
	   var features = [];
	   var features2 = [];
	   window.lat = 36.834160;
	   window.lng = 127.179390;

	   function ddd(){
			location.reload();
		}
			setInterval(ddd,5000);

		var initialize = function() {

		 map  = new google.maps.Map(document.getElementById('map-canvas'), 

		 {center:new google.maps.LatLng(lat2[0], lat2[1]), zoom:15});

		features2[0]={position : new google.maps.LatLng(lat2[0], lat2[1]),
			type: 'info'
		}

		 mark = new google.maps.Marker({
			position:features2[0].position,
			 map:map
			 });

		for(b=0;b<marker_cou;b=b+2){
			features[b/2] = {position : new google.maps.LatLng(lat1[b], lat1[b+1]),
			type: 'info'
		}

		}

		 while(i<marker_cou){

			mark2 = new google.maps.Marker({
			position: features[i/2].position,
			map:map,
			icon: {
			url: "http://maps.google.com/mapfiles/ms/icons/blue-dot.png"
		        }
                   });
		   i=i+2;
	  }
      console.log("이니셜라이즈 성공");

   };

   window.initialize = initialize;

   </script>

   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyB5hlXYJVaElukvg7LI5YVs0ycGEP0JnaE&callback=initialize"></script>

 </body>

</html>​
