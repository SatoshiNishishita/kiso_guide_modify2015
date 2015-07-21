<?php

//データベースに接続
require('dbconnect.php');

// MySQLとの接続をオープンにする
$db = mysql_connect($DBSERVER, $DBUSER, $DBPASSWORD) or die(mysql_error());

// データをUTF8で受け取る
mysql_query("SET NAMES UTF8");

// データベースを選択する
$selectdb = mysql_select_db($DBNAME, $db);

?>

<?php

//kiso_guideからデータを取得
$recordSet = mysql_query('SELECT * FROM spot WHERE spot_boolean=1',$db);
$data = mysql_fetch_assoc(recordSet);
?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>木曽三川公園センター</title>
	
	<!-- Bootstrap-->
	<meta name="viewport" content="initial-scale=1.0, user-scale=no" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!--CSS-->
	<link href="css/style.css" rel="stylesheet" type="text/css">
	
	<!--googleマップを使うたまえのコード-->
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true"></script>

</head>
<body>

<br />
<div class="container">
	<div id="header">
		<div class="col-xs-2"><br />
			<img src="photos/images.png" class="img-responsive">
		</div>
		<div class="col-xs-8">
			<h1>木曽三川公園センター社会科見学ガイド</h1><br />
			<h4 id="descript">
				このウェブページを社会科見学の事前学習として利用しよう<br />
				木曽三川公園には治水の歴史を知れるスポットがいっぱいあるよ<br />
				この土地に住む人の生の声を聞いてみよう<br />
			</h4>
		</div>
		<div class="col-xs-2">
			<img src="photos/sidouin.png" class="img-responsive">
		</div>	
	</div>
</div>
<hr>
<br />
<br />
<div class="container">

	<ul class="nav nav-pills nav-justified">
		<li><a href="../kiso_guide2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<li class="active"><a href="map.php"><span class="glyphicon glyphicon-th-large"></span>地図</a></li>
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat"></span>更新</a></li>
	</ul>

</div>

<br />
<br />
<br />

<div class="container">
<!--地図を表示するためのキャンパス作成-->
<div id="map_canvas" style="width=100%; height:500px" class="imv-responsive"></div>

 </div>
<!--Javascript-->
<script type="text/javascript">
	
	//地図を表示するためのjavascript
	var latlng = new google.maps.LatLng(35.14754717802414,136.6672718524933);//このパラメータで緯度経度を指定して表示する画面を指定している
	var myOptions = {
		zoom: 16,//最初のズームレベル
		center: latlng,//表示する場所の指定
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		sensor: true//GPSの起動を許可
	};
	var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
	
	
	//地図上にスポットのマーカーを立てる
		var marker1 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1474,136.666),
			});
			
		var marker2 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1462,136.668),
			});
		
		var marker3 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1443,136.668),
			});
		
		var marker4 = new google.maps.Marker({
			map: map,
			position: new google.maps.LatLng(35.1431,136.668),
			});

	
		//マーカーに吹き出しを表示させて、リンクをつける
		var infowindow1 = new google.maps.InfoWindow({
			content: '<a href="spot_movie.php?id=1">農家と水屋</a>'
			//<img src="img/spot_img1.jpg" width='50' height='50' />
			});
			infowindow1.open(map, marker1);
			
		var infowindow2 = new google.maps.InfoWindow({
			content: '<a href="spot_movie.php?id=2">治水タワー</a>'
			});
			infowindow2.open(map, marker2);
			
		var infowindow3 = new google.maps.InfoWindow({
			content: '<a href="spot_movie.php?id=3">治水神社</a>'
			});
			infowindow3.open(map, marker3);
		
		var infowindow4 = new google.maps.InfoWindow({
			content: '<a href="spot_movie.php?id=4">締切堤</a>'
			});
			infowindow4.open(map, marker4);
			
</script>


</body>
</html>