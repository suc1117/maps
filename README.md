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
php정보를 보고 싶으면 ```<?php phpinfo(); ?>```를 넣으면 됩니다.


2.쉘 파일 자동 실행
라즈베리파이를 부팅하고 바로 실행하고 싶은 터미널 명령이 있을 때 사용
```Nano 만들고 싶은 이름.sh```

맨 위에 /#! /bin/bash 입력 한 후
터미널 명령어 입력

권한부여
Chmod 755 만들고 싶은 이름.sh

Sudo nano /etc/xdg/lxsession/LXDE-pi/autostart
가장 밑에 부분에 만들고 싶은 이름.sh을 추가해주면
reboot할때마다 자동으로 실행이 된다.

3.maps는 html5의 geolocation 기능을 사용한 것이고, maps2는 새로고침을 이용한 방법이다.
maps는 일시적인 chromium 오류로 인해 현재는 안되고 있지만, 해결 될 것이다.
실시간 위치 표시와 장애물 마커 표시 (새로고침 버전)
위치는 아파치 서버 경로 /var/www/html/에 넣어야 한다.
PHP문을 통해 파일을 읽어오는데 읽어 오는 파일도 apache 서버 경로에 있어야 한다.
받아온 파일 내용을 읽어와 html 스크립트 구문에서 변수로 받아와서 사용한다

