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

//index.phpからIDを受け取る
$id = $_GET['id'];

//受け取ったspot_idを参照してスポットの情報を受け取る
$recordSet = mysql_query("SELECT * FROM spot WHERE spot_id = '$id'", $db);
$data = mysql_fetch_assoc($recordSet);

//動画
$recordSetMovie = mysql_query("SELECT * FROM movie WHERE spot_id='$id'", $db);



?>


<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>木曽三川公園センター管理画面</title>
	
	<!-- Bootstrap-->
	<meta name="viewport" content="initial-scale=1.0, user-scale=no" />
	<link href="css/bootstrap.min.css" rel="stylesheet">
	
	<!-- CSS-->
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
			<h2 class= "text-center"><?php echo $data['spot_name'];?></h2><br />
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
<br />
<br />

<div class="container">
	
	<ul class="nav nav-pills nav-justified">
		<li><a href="../kiso_guide_modify2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<li class="active"><a href="spot_movie.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-facetime-video">動画</a></li>
		<li><a href="spot_photo.php?id=<?php echo $id; ?>"><span class="glyphicon glyphicon-camera">写真</a></li>
		<li><a href="../kiso_guide2015/"><span class="glyphicon glyphicon-eye-open"></span>児童用ページ</a></li>
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat">更新</a></li>
		
	</ul>
	<br /><br />	

	<!--グリッドレイアウト2段組-->
	<div class="text-center">
		<?php
			while($movie_data = mysql_fetch_assoc($recordSetMovie)){
		?>
			<div id="left">
				<div class="col-xs-6">
					<h3><?php echo $movie_data['movie_title'];?></h3><br /><br />
					<div id="movie"><video src="movies/<?php echo $movie_data['movie_url'];?>.mp4" poster= "photos/<?php echo $movie_data['video_img']?>.png"width="100%" controls preload="none"></div><br /><br />
					<h4><?php echo $movie_data['movie_text'];?></h4>
					
					<form action="input.php" method="post">
						<input type="hidden" name = "movieid" value = "<?php echo $movie_data[ 'movie_id'];?>" />
						<div class="form-group">
							<p>この動画の表示/非表示を選択する</p>
							<div class="radio-inline">
								<input type="radio" value="1" name="movieindication" id ="hyouzi" checked>
								<label for = "man">表示</label>
							</div>
							<div class="radio-inline">
								<input type="radio" value="0" name="movieindication" id ="hihyouzi">
								<label for = "woman">非表示</label>
							</div>
						</div>
						<input type="submit" value="変更を適用" class="btn btn-default">
					</form>	
				</div>
			</div>
			
		<?php
			}
		?>
		
	</div>	
	
</div>

<footer>
</footer>

<script>
</script>


</body>
</html>
