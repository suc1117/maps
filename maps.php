<?php
	$i=0;
	$result = "";
	$lines = array();
	$lines = @file("data.txt") or $result = "파일을 읽을 수 없습니다.";
	if ($lines != null){
		for($i = 0;$i < count($lines);$i++){
			$result .= ($i + 1) . ": " . $lines[$i] . "<br>";
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
	   var lng1;
	   var qoduf = new Array();
	   var count=0;
	   var features = [];
	   window.lat = 36.834160;
	   window.lng = 127.179390;
	   
	  
	   /*function ddd(){
			location.reload();
		}
			setInterval(ddd,5000);*/
			
	   
	   /*
	   function getLocation() {
		   if (navigator.geolocation) {
			   navigator.geolocation.getCurrentPosition(updatePosition);
		   }
		   return null;
	   };
	  
	   function updatePosition(position) {
		 if (position) {
		   window.lat = position.coords.latitude;
		   window.lng = position.coords.longitude;
		   console.log(window.lng);
		 }
	   };
	   setInterval(function(){updatePosition(getLocation());}, 50000);
	   */
           
	   
	   
﻿	   	
	
	   function currentLocation() {
		 return {lat:window.lat, lng:window.lng};
	   };
	   
	   
	   
	   
	   
		var initialize = function() {
		 map  = new google.maps.Map(document.getElementById('map-canvas'), 
		 {center:{lat:lat,lng:lng}, zoom:15});
        
		 mark = new google.maps.Marker({
			position:{lat:lat, lng:lng},
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
		   //console.log(i);
		   //console.log(lat1[i]);
		   //console.log(lng1);
		   i=i+2;
	  }
			
      console.log("이니셜라이즈 성공");
   };
   window.initialize = initialize;
   
   
   
   
   var geo_options = {
		enableHighAccuracy: true, 
		maximumAge        : 30000, 
		timeout           : 45000
		};

	   function geo_success(position) {
		      console.log("위치받기 성공잼");
		    window.lat = position.coords.latitude;
		    window.lng = position.coords.longitude;
		};
		
		setInterval(function() {
			navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);
		}, 10000);
	   function geo_error(err) {
		 //console.warn('Error-----('+err.code+'):'+err.message);
		 console.log("실패");
		};
	   if(navigator.geolocation) {
		   navigator.geolocation.watchPosition(geo_success, geo_error, geo_options);
		}
		else{
			alert("안됌");
		}
   
   
   var redraw = function(payload) {
	   console.log("리드로우 실행");
     lat = payload.message.lat;
     lng = payload.message.lng;
     map.setCenter({lat:lat, lng:lng, alt:0});
     mark.setPosition({lat:lat, lng:lng, alt:0});
     //mark2.setPosition({lat:lat1[0], lng:lat1[1], alt:0});
   };
   
   var pnChannel = "map2-channel";
   var pubnub = new PubNub({
     publishKey:   'pub-c-73cb03fb-7b31-4fc5-b6d6-956bfd2c6c0d',
     subscribeKey: 'sub-c-162d3c8c-1273-11ea-bcdc-a6989f9d21fe'
   });
   
   pubnub.subscribe({channels: [pnChannel]});
   pubnub.addListener({message:redraw});
   setInterval(function() {
     pubnub.publish({channel:pnChannel, message:currentLocation()});
      //console.log(window.lat);
      //console.log(window.lng);
     
   }, 1500);
   
   
   
   </script>
   <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyB5hlXYJVaElukvg7LI5YVs0ycGEP0JnaE&callback=initialize"></script>
 </body>
</html>​
