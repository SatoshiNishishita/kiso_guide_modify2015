
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
$recordSet = mysql_query('SELECT * FROM spot',$db);

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
<hr>
<br />
<br />
<div class="container">

	<ul class="nav nav-pills nav-justified">
		<li class="active"><a href="../kiso_guide2015"><span class="glyphicon glyphicon-home"></span>ホーム</a></li>
		<!--<li><a href="map.php"><span class="glyphicon glyphicon-th-large"></span>地図</a></li>-->
		<li><a href="javascript:location.reload(true);" data-role="button" data-icon="refresh"><span class="glyphicon glyphicon-repeat"></span>更新</a></li>
		<li><a href="../kiso_guide2015/"><span class="glyphicon glyphicon-eye-open"></span>児童用ページ</a></li>
	</ul>
	
	
	<br />
	<br />	
	<br />

	<!--グリッドレイアウト2段組-->
	<div class="text-center">
	<?php
		//while文で$recordSetからデータベースの情報を一つずつ取り出す
		while($data = mysql_fetch_assoc($recordSet)){
	?>
			<div id="left">
			<div class="col-xs-6">
			<h3><?php echo $data['spot_name'];?></h3><br /><br />
			<div class="spot_photo"><img src="photos/spot_img<?php echo $data['spot_id']; ?>.jpg"  class="img-responsive "width="100%"></div><br />
			<h4 class="text"><?php echo $data['spot_text'];?><br /><br /></h4>
			<a href="spot_movie.php?id=<?php echo $data['spot_id'];?>">このスポットについて調べる</a><br /><br />
			<br />
			
			<form action="input.php" method="post">
				<input type="hidden" name = "id" value = "<?php echo $data[ 'spot_id'];?>" />
				<div class="form-group">
					<p>このスポットの表示/非表示を選択する</p>
					<div class="radio-inline">
						<input type="radio" value="1" name="indication" id ="hyouzi" checked>
						<label for = "man">表示</label>
					</div>
					<div class="radio-inline">
						<input type="radio" value="0" name="indication" id ="hihyouzi">
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

<br />
<br />


<footer class="text-center">
<h4>&copy;YESLab,Nagoya University</h4>
</footer>

</body>
</html>