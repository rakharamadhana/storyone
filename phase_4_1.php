
<?php  
session_start();
 
if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

// memanggil functions.php
require 'functions.php';

// mengirim query ke functions.php
$userid = $_SESSION["userId"]; 
// PHASE 1
$userku = query("SELECT * FROM user WHERE id = '$userid' ");
$themeku = query("SELECT nama FROM theme WHERE user = '$userid' ");
$reasonku = query("SELECT nama FROM theme_reason WHERE user = '$userid' ");
$reasonku2 = query("SELECT * FROM theme_reason2 WHERE user = '$userid' ");
$purposeku = query("SELECT nama FROM purpose_desc WHERE user = '$userid' ");
$outlineku = query("SELECT nama FROM outline_desc WHERE user = '$userid' ");
$toolsku = query("SELECT nama FROM tools_desc WHERE user = '$userid' ");
// PHASE 2
$designku = query("SELECT keterangan FROM design WHERE user = '$userid' ORDER BY page_order ");
// PHASE 3
//$reflectku = query("SELECT nama FROM reflect WHERE user = '$userid' ");
//$reflect2ku = query("SELECT nama FROM reflect2 WHERE user = '$userid' ");
//$presentationku = query("SELECT nama FROM presentation WHERE user = '$userid' ");
$peerku = query("SELECT * FROM peer_reflection WHERE pilih = '$userid' ORDER BY pilih ");
$peerku2 = query("SELECT * FROM peer_reflection2 WHERE pilih = '$userid' ORDER BY pilih ");
$peerku3 = query("SELECT * FROM peer_reflection3 WHERE pilih = '$userid' ORDER BY pilih ");
$peerlist = query("SELECT * FROM peer_reflection WHERE user = '$userid' ORDER BY id ASC");
$peerlist2 = query("SELECT * FROM peer_reflection2 WHERE user = '$userid' ORDER BY id ASC");
$peerlist3 = query("SELECT * FROM peer_reflection3 WHERE user = '$userid' ORDER BY id ASC");
$presentationku = query("SELECT gambar FROM filestory WHERE user = '$userid' ");
$presentationdesign = query("SELECT gambar FROM filedesign WHERE user = '$userid' ");
$groupku = query("SELECT * FROM group_diss WHERE user = '$userid' OR user2 = '$userid' OR user3 = '$userid' OR user4 = '$userid' OR user5 = '$userid' ");

?>

<!DOCTYPE html>
<html>
<title>GIDLE - Storytelling</title>
<script src='https://kit.fontawesome.com/2f5efb9e2a.js'></script>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<link rel="shortcut icon" href="images/favicon.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body {
  background-image: url('images/background_hijau.png');
  background-repeat: no-repeat;
  background-attachment: fixed;  
  background-size: cover;
}

</style>

<body class="w3-text-white">	

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-green w3-xxlarge" style="width:70px">
    <a href="menu.php" class="w3-bar-item w3-button"><i class="fa fa-home"></i></a>
    <a href="phase_1_1.php" class="w3-bar-item w3-button"><i class="fa fa-book"></i></a>
    <a href="phase_2_1.php" class="w3-bar-item w3-button"><i class="fa fa-pencil"></i></a>
    <a href="phase_3_1.php" class="w3-bar-item w3-button"><i class="fa fa-users"></i></a>
    <a href="phase_4_1.php" class="w3-bar-item w3-button"><i class="fa fa-file"></i></a>
    <a href="phase_5_chat.php" class="w3-bar-item w3-button"><i class="fa fa-comments"></i></a>
    <a href="logout.php" class="w3-bar-item w3-button"><i class="fa fa-power-off"></i></a>
</div>

<div style="margin-left:70px">
<!-- Last Sidebar -->


<div class="w3-content w3-display-container" style="max-width:900px">

<header class="w3-container w3-center w3-animate-left">
  <a href="index.php" style="text-decoration:none;"><h1><img src="images/icon_story.png" width="40px"> RDST reflect with DST <br>數位敘事反思平台</h1></a>
</header>

<div class="w3-container w3-margin-top w3-large w3-mobile">
	
	<div class="w3-row">
	  <div class="w3-col w3-container w3-xxlarge"><h1>我們的數位敘事簡介</h1></div>
	</div>
	<div class="w3-row">
	  <div class="w3-col w3-container"><p>你可以在此頁面看到你之前已經完成的所有內容。</p></div>
	</div>
	<!-- Mulai baris -->
	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-rest"><h1><a href="phase_1_1.php" class="w3-button w3-section w3-green w3-ripple" style="width: 100%;">階段一:我們的數位敘事的主題、目的、大綱和工具</a></h1>
	  </div>
	  <div class="w3-col w3-container w3-rest">
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 使用者名稱 :</span> <br>

		<?php foreach ( $userku as $row ) : ?>
			<?= $row["username"]; ?>
		<?php endforeach; ?> <br>
    	Code : [ <?= $row["id"]; ?> ]
	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 主題 :</span> <br>

		<?php foreach ( $themeku as $row ) : ?>
			<?= $row["nama"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 原因一 :</span> <br>

		<?php foreach ( $reasonku as $row ) : ?>
			<?= $row["nama"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 原因二 :</span> <br>
	  	來源 :
		<?php foreach ( $reasonku2 as $row ) : ?>
			<?= $row["nama"]; ?> <br>
		<?php endforeach; ?>
		原因 : 
		<?php foreach ( $reasonku2 as $row ) : ?>
			<?= $row["reason"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 目的 :</span> <br>

		<?php foreach ( $purposeku as $row ) : ?>
			<?= $row["nama"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 大綱 :</span> <br>

		<?php foreach ( $outlineku as $row ) : ?>
			<?= $row["nama"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 工具和呈現方式 :</span> <br>

		<?php foreach ( $toolsku as $row ) : ?>
			<?= $row["nama"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  </div>
	</div>
	<!-- Akhir baris -->
	<!-- Mulai baris -->
	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-rest"><h1><a href="phase_2_1.php" class="w3-button w3-section w3-green w3-ripple" style="width: 100%;">階段二:我們的腳本設計</a></h1>
	  </div>
	  <div class="w3-col w3-container w3-rest">
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 腳本設計 :</span> <br>

	  	<?php $i = 1; ?>
		<?php foreach ( $designku as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["keterangan"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

		<br>
	  	<b>檔案 :</b> <br>
	  	<?php $i = 1; ?>
		<?php foreach ( $presentationdesign as $row ) : ?>
			<?= $i; ?><?= ". "; ?>
			<?= $row["gambar"]; ?> 
			<a href="filestory_upload/<?= $userid; ?>/<?= $row["gambar"]; ?>" target="_blank" download><i class='fas fa-download'></i></a>
			<br> 
		<?php $i++; ?>
		<?php endforeach; ?> 
	  </p>
	  <!-- End File Presentation-->


	  </p>
	  </div>
	</div>
	<!-- Akhir baris -->
	<!-- Mulai baris -->
	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-rest"><h1><a href="phase_3_1.php" class="w3-button w3-section w3-green w3-ripple" style="width: 100%;">階段三:反思和討論</a></h1>
	  </div>
	  <div class="w3-col w3-container w3-rest">

	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 同儕草稿一Draft 1回饋：</span> <br>
		
		<b>同儕給<span style="color: red;">我的</span>建議</b><br>
	  	<?php $i = 1; ?>
		<?php foreach ( $peerku as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["username"]; ?> : <?= $row["nama"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

		<br>
		<b><span style="color: red;">我給</span>同儕的回饋</b><br>
	  	<?php $i = 1; ?>
		<?php foreach ( $peerlist as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["pilih_user"]; ?> : <?= $row["nama"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

	  </p>

	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 同儕草稿二Draft 2回饋：</span> <br>
		
		<b>同儕給<span style="color: red;">我的</span>建議</b><br>
	  	<?php $i = 1; ?>
		<?php foreach ( $peerku2 as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["username"]; ?> : <?= $row["nama"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

		<br>
		<b><span style="color: red;">我給</span>同儕的回饋</b><br>
	  	<?php $i = 1; ?>
		<?php foreach ( $peerlist2 as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["pilih_user"]; ?> : <?= $row["nama"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

	  </p>

	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 期末成發Final回饋：</span> <br>
		
		<b>同儕給<span style="color: red;">我的</span>建議</b><br>
	  	<?php $i = 1; ?>
		<?php foreach ( $peerku3 as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["username"]; ?> : <?= $row["nama"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

		<br>
		<b><span style="color: red;">我給</span>同儕的回饋</b><br>
	  	<?php $i = 1; ?>
		<?php foreach ( $peerlist3 as $row ) : ?>
			<?= $i; ?><?= ". "; ?><?= $row["pilih_user"]; ?> : <?= $row["nama"]; ?><br>
		<?php $i++; ?>
		<?php endforeach; ?>

	  <!-- File Presentation-->
	  </p>
	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 期末成發 :</span> <br>
	  	<b>檔案 :</b> <br>
	  	<?php $i = 1; ?>
		<?php foreach ( $presentationku as $row ) : ?>
			<?= $i; ?><?= ". "; ?>
			<?= $row["gambar"]; ?>
			<a href="filestory_upload/<?= $userid; ?>/<?= $row["gambar"]; ?>" target="_blank" download><i class='fas fa-download'></i></a>
			<br> 
		<?php $i++; ?>
		<?php endforeach; ?> 
	  </p>
	  <!-- End File Presentation-->

	  <p><span style="font-size: 30px;"><i class='fas fa-caret-right'></i> 小組討論 :</span> <br>

		<?php foreach ( $groupku as $row ) : ?>
			<?= $row["group_name"]; ?> : <?= $row["nama"]; ?> <br>
		<?php endforeach; ?>

	  </p>
	  </div>
	</div>
	<!-- Akhir baris -->
</div>
  
</div>

  <div class="w3-container">
    <p class="w3-large">Graduate Institute of Digital Learning and Education</p>
    <p>powered by <a href="https://www.gidle.ntust.edu.tw/home.php?Lang=en" target="_blank">GIDLE - NTUST</a></p>
  </div>

</body>
</html>

