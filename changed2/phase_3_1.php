<?php  
session_start(); 

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

// memanggil functions.php
require 'functions.php';
 

if ( isset($_POST["submit"]) ) {
	// var_dump($_POST); untuk nge-test

	// cek apakah data berhasil ditambahkan atau tidak
	if ( tambah($_POST) > 0 ) {
		echo "
			<script>
			alert('file uploaded successfully!');
			document.location.href = 'phase_3_1.php';
			</script>
		";
	} else {
		echo "
			<script>
			alert('file failed to upload!');
			document.location.href = 'phase_3_1.php';
			</script>
		";
	}

}



// Menampilkan file-fila yang sudah di upload
$userid = $_SESSION["userId"];
$filestory = query("SELECT * FROM filestory WHERE user = '$userid' ORDER BY id ASC");


?>

<!DOCTYPE html>
<html>
<title>GIDLE - Storytelling</title>
<script src='https://kit.fontawesome.com/a076d05399.js'></script>
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
  <a href="phase_1_1.php" class="w3-bar-item w3-button"><i class="fas fa-dice-one"></i></a> 
  <a href="phase_2_1.php" class="w3-bar-item w3-button"><i class="fas fa-dice-two"></i></a> 
  <a href="phase_3_1.php" class="w3-bar-item w3-button"><i class="fas fa-dice-three"></i></a>
  <a href="phase_4_1.php" class="w3-bar-item w3-button"><i class="fas fa-file-alt"></i></a>
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
	  <div class="w3-col w3-container w3-xxlarge"><h1>階段三 : 反思和討論</a></h1></div>
	</div>
	<div class="w3-row">
	  <div class="w3-col w3-container"><!--<p>完成數位敘事後，你和你的小組成員需要依據整學期以來一起完成成品的反思內容</p>--></div>
	</div>

	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-third"><p>草稿一 Draft 1 : </p></div>
	<div class="w3-col w3-container w3-twothird"><h1><a href="phase_3_1_peerreflection.php" class="w3-button w3-section w3-green w3-ripple" style="width:100%">數位敘事同儕回饋

</a><!-- <a href="phase_3_1_step2_flipped.php" class="w3-button w3-section w3-green w3-ripple" style="width:50%">week 2</a>--></h1></div>

	  <!-- <div class="w3-col w3-container w3-quarter"><p>Personal homework (takehome)</p></div>
	  <div class="w3-col w3-container w3-quarter"><p>Finished</p></div> -->
	</div>

	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-third"><p>草稿二 Draft 2 : </p></div>
	<div class="w3-col w3-container w3-twothird"><h1><a href="phase_3_2_peerreflection.php" class="w3-button w3-section w3-green w3-ripple" style="width:100%">數位敘事同儕回饋

</a></h1></div>
	</div>

	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-third"><p>期末成發 Final : </p></div>
	<div class="w3-col w3-container w3-twothird"><h1><a href="phase_3_3_peerreflection.php" class="w3-button w3-section w3-green w3-ripple" style="width:100%">數位敘事同儕回饋

</a></h1></div>
	</div>


	<!-- Submit file storytelling -->
	<form action="" method="POST" enctype="multipart/form-data">
	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-third"><p>期末成發 : </p></div>
	<div class="w3-col w3-container w3-twothird"><span class="w3-button w3-section w3-green w3-ripple" style="width:100%"><input type="file" name="gambar"></span><button type="submit" name="submit">Upload file</button>
 
	<!-- Looping for the div table -->
	<?php $i = 1; ?>	
	<?php foreach ( $filestory as $row ) : ?>

	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-half"><p><?= $row["gambar"]; ?></p></div>
	  <div class="w3-col w3-container w3-quarter"><a href="phase_3_1_delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Do you want to delete?');" class="w3-button w3-section w3-green w3-ripple"><i class='far fa-trash-alt' style='font-size:24px'></i></a></div>
	</div>

	<?php $i++; ?>
	<?php endforeach; ?>	
	<!-- End looping for the div table -->

	</div>
	</div>
	</form>
	<!-- Akhir submit file storytelling -->


	<div class="w3-row w3-light-green">
	  	<div class="w3-col w3-container w3-xxlarge"><h1><a href="phase_3_3_group.php" class="w3-button w3-section w3-green w3-ripple" style="width:100%">期末個人和小組反思</a></h1></div>
	</div>
</div>
  
</div>

  <div class="w3-container">
    <p class="w3-large">Graduate Institute of Digital Learning and Education</p>
    <p>powered by <a href="https://www.gidle.ntust.edu.tw/home.php?Lang=en" target="_blank">GIDLE - NTUST</a></p>
  </div>

</body>
</html>

