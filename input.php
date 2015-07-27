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
//スポットの変更を受け取るby index.phpから
$spot_id = $_POST['id'];
$spot_indication = $_POST['indication'];
$sql = "UPDATE spot SET spot_boolean='$spot_indication' WHERE spot_id =  '$spot_id'";
mysql_query($sql,$db);
?>

<?php
//動画の変更を受け取る by spot_movie.phpから
$movie_id = $_POST['movieid'];
$movie_indication = $_POST['movieindication'];
$sql = "UPDATE movie SET movie_boolean='$movie_indication' WHERE movie_id =  '$movie_id'";
mysql_query($sql,$db);
?>

<?php
//写真の変更を受け取る by spot_photo.phpから
$photo_id = $_POST['photoid'];
$photo_indication = $_POST['photoindication'];
$sql = "UPDATE photo SET photo_boolean= '$photo_indication' WHERE photo_id = '$photo_id' ";
mysql_query($sql,$db);
?>


<?php
//受けとったspotのidを使ってqueryする
$recordSet = mysql_query("SELECT * FROM spot WHERE spot_id = '$spot_id'",$db);
$data =mysql_fetch_assoc($recordSet);
?>

<?php
//受け取ったmovieのidを使ってqueryする
$recordSetMovie = mysql_query("SELECT * FROM movie WHERE movie_id='$movie_id'", $db);
$movie_data = mysql_fetch_assoc($recordSetMovie);
?>

<?php
//受け取ったphotoのidを使ってqueryする
$recordSetPhoto = mysql_query("SELECT * FROM photo WHERE photo_id='$photo_id'", $db);
$photo_data = mysql_fetch_assoc($recordSetPhoto);
?>

<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>木曽三川公園センター管理画面</title>
	
	<!-- Bootstrap-->
	<meta name="viewport" content="initial-scale=1.0, user-scale=no" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
	
	<!--CSS-->
	<link href="css/style.css" rel="stylesheet" type="text/css">
</head>

<body>

<br />
<div class="container">
	<div id="header">
		<div class="col-xs-2"><br />
			<img src="photos/images.png" class="img-responsive">
		</div>
		<div class="col-xs-8">
			<h1>木曽三川社会科見学ガイド管理画面</h1><br />
			<h4 id="descript">
				このウェブページは事前学習で使うコンテンツの管理するウェブページです<br />
				コンテンツごとに表示/非表示を変更が可能
			</h4>
		</div>
		<div class="col-xs-2">
			<img src="photos/sidouin.png" class="img-responsive">
		</div>	
	</div>
</div>

<div class="container">
	<ul class="nav nav-pills nav-justified">
		<li class="active"><a href="../kiso_guide_modify2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<!--<li><a href="map.php"><span class="glyphicon glyphicon-th-large"></span>地図</a></li>-->
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat"></span>更新</a></li>
		<li><a href="../kiso_guide2015/"><span class="glyphicon glyphicon-eye-open"></span>児童用ページ</a></li>
	</ul>


	<br />
	<br />
	<br />
	<!--変更を通知する-->
	<div class="col-xs-offset-4 col-xs-4">
	<div id="answer" class="text-center">	
	
		<?php
			//spotの変更を通知
		 	if($spot_id){
		 ?>
		 	 <?php
				if($spot_indication == 1){
			?>
				<h3><?php echo $data['spot_name'];?></h3><br /><h4>表示に切り替えました</h4><br />
				<div id="inputimg"><img src="photos/spot_img<?php echo $data['spot_id']; ?>.jpg"  class="img-responsive "width="100%"></div>
			<?php		
				}else{
		 	 ?>
	 			<h3><?php echo $data['spot_name'];?></h3><br /><h4>非表示に切り替えました</h4><br />
	 			<div id="inputimg"><img src="photos/spot_img<?php echo $data['spot_id']; ?>.jpg"  class="img-responsive "width="100%"></div>
		 	<?php
	 			}
		 	?>
		 <?php		
		 	}
		?>
		
		<?php
			//movieの変更を通知
			if($movie_id){
		?>
			<?php
				if($movie_indication == 1){	
			?>
				<h3><?php echo $movie_data['movie_title'];?></h3><br /><h4>表示に切り替えました</h4><br />
				<div id="movie"><video src="movies/<?php echo $movie_data['movie_url'];?>.mp4" poster= "photos/<?php echo $movie_data['video_img']?>.png"width="100%" controls preload="none"></div>
			<?php
				}else{
			?>
				<h3><?php echo $movie_data['movie_title'];?></h3><br /><h4>非表示に切り替えました</h4><br />
				<div id="movie"><video src="movies/<?php echo $movie_data['movie_url'];?>.mp4" poster= "photos/<?php echo $movie_data['video_img']?>.png"width="100%" controls preload="none"></div>
			<?php
				}
			?>
		
		<?php
			}
		?>
		
		<?php
			//photoの変更を通知
			if($photo_id){
		?>
			<?php
				if($photo_indication == 1){	
			?>
				<h3><?php echo $photo_data['photo_title'];?></h3><br /><h4>表示に切り替えました</h4><br />
				<div id="slickimg"><img src="photos/<?php echo $photo_data['photo_url'];?>.jpg" width = 100% class="img-responsive"></div>
			<?php
				}else{
			?>
				<h3><?php echo $movie_data['photo_title'];?></h3><br /><h4>非表示に切り替えました</h4><br />
				<div id="slickimg"><img src="photos/<?php echo $photo_data['photo_url'];?>.jpg" width = 100% class="img-responsive"></div>
			<?php
				}
			?>
		
		<?php
			}
		?>

	
		<br />
		<br />
		<br />

		<button class="btn btn-primary btn-lg" type=" button" onclick="location.href='../kiso_guide2015'">児童用ページで変更を確認する</button>

	</div>
	</div>


	<br />
	<br />
	<br />

</div>

<br />
<br />
<br />

<footer class="text-center">
	<h4>&copy;YESLab,Nagoya University</h4>
</footer>

<script type= "text/javascript">

	window.alert('変更しました');

</script>

</body>
</html>

