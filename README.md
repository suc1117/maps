# maps

라즈베리파이 
1.APACHE + PHP
APACHE 설치 방법 : 
터미널창 실행 후에
<pre>Sudo apt-get update</pre>
```Sudo apt-get install apache2 -y```

아파치 설치 완료
테스트할때에는 브라우지 실행 후 localhost 또는 인터넷 ip주소를 입력하면
<img src="https://user-images.githubusercontent.com/48506474/70411451-9f1abb80-1a95-11ea-9458-be031e5a0202.png" width=400px>
위와 같은 창이 뜬다. 서버의 경로는 /var/www/html/로 기본 설정된다.
그 안에 index.html이 있는데 index.html이 기본 페이지이다.

PHP 설치 하는법 :
<pre>Sudo apt-get install php libapache2-mod-php -y</pre>
Sudo nano 만들고 싶은 파일이름.php

Php 구문 작성 : 
```<?php echo “hello world”; ?>```
Localhost/만들고 싶은 파일이름.php를 치면
Hello world를 볼 수 있다.
php정보를 보고 싶으면 ```<?php phpinfo(); ?>```를 넣으면 아래와 같이 페이지에 나타납니다.


<img src="https://user-images.githubusercontent.com/48506474/70418585-0725cd80-1aa7-11ea-87e1-2be2069363c7.jpg" width=400px>



2.maps2는 새로고침을 이용한 방법이다.
실시간 위치 표시와 장애물 마커 표시 (새로고침 버전)
위치는 아파치 서버 경로 /var/www/html/에 넣어야 한다.
PHP문을 통해 파일을 읽어오는데 읽어 오는 파일도 apache 서버 경로에 있어야 한다.
받아온 파일 내용을 읽어와 html 스크립트 구문에서 변수로 받아와서 사용한다.
```
<?php
	$i=0;
	$j=0;
	$result = "";
	$result2 = "";
	$lines = array();
	$lines2 = array();
	$lines = @file("data.txt") or $result = "파일을 읽을 수 없습니다.";//장애물 위치
	$lines2 = @file("location.txt") or $result = "파일을 읽을 수 없습니다.";//현재 

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
```
```var lat1 = <?= json_encode($lines) ?>;```

```var lat2 = <?= json_encode($lines2) ?>;```


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

    장애물마커표시
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

maps1.php(html5의 geolocation을 활용)
현재 chromium의 일시적인 오류로 인해 안되지만 컴퓨터 크롬을 통해 확인 결과 문제가 없었다.
maps.php와 비슷하나 위와 같은 부분이 추가 되었다.



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
   
3.쉘 파일 자동 실행
라즈베리파이를 부팅하고 자동으로 위에 만든 php파일을 실행하고 싶을 때 아래와 같은 방법을 사용합니다.
```sudo nano 만들고 싶은 이름.sh```

맨 위에 /#! /bin/bash 입력 한 후
터미널 명령어 입력

권한부여
sudo chmod 755 만들고 싶은 이름.sh

1. 라즈베리 파이 부팅 후 terminal 실행
2. sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
3. 제일 아랫 줄에 실행 명령어 추가
    이 때 앞에 나오는 명령어는 절대경로로 적어주시면 되겠습니다. 명령어의 위치를 모르시겠다면 터미널에서
    which 명령어 를 입력하시면 해당 명령어의 경로가 출력됩니다.
4. 저장 후 재부팅
