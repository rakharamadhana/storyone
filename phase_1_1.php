<?php  
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

// memanggil functions.php
require 'functions.php';

?>

<!DOCTYPE html>
<html>
<title>GIDLE - Storytelling</title>
<script src="https://kit.fontawesome.com/2f5efb9e2a.js" crossorigin="anonymous"></script>
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
	  <div class="w3-col w3-container w3-xxlarge"><h1>階段一 : 探索數位敘事的主題和組織故事內容</a></h1></div>
	</div>
	<div class="w3-row">
	  <div class="w3-col w3-container"><p>根據小組的討論和設計，此階段包含主題、目的、大綱和呈現方式</p></div>
	</div>
	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-quarter"><h1><a href="phase_1_1_step1.php" class="w3-button w3-section w3-green w3-ripple">步驟一</a></h1></div>
	  <div class="w3-col w3-container w3-half"><p>確認主題和目的</p></div>
	  <!-- <div class="w3-col w3-container w3-quarter"><p>Unfinished</p></div> -->
	</div>
	<div class="w3-row w3-light-green">
	  <div class="w3-col w3-container w3-xxlarge w3-quarter"><h1><a href="phase_1_1_step2.php" class="w3-button w3-section w3-green w3-ripple">步驟二</a></h1></div>
	  <div class="w3-col w3-container w3-half"><p>確認故事背景</p></div>
	  <!-- <div class="w3-col w3-container w3-quarter"><p>Unfinished</p></div> -->
	</div>
	<div class="w3-row w3-lime">
	  <div class="w3-col w3-container w3-xxlarge w3-quarter"><h1><a href="phase_1_1_step3.php" class="w3-button w3-section w3-green w3-ripple">步驟三</a></h1></div>
	  <div class="w3-col w3-container w3-half"><p>確認故事大綱</p></div>
	  <!-- <div class="w3-col w3-container w3-quarter"><p>Unfinished</p></div> -->
	</div>
	<div class="w3-row w3-light-green">
	  <div class="w3-col w3-container w3-xxlarge w3-quarter"><h1><a href="phase_1_1_step4.php" class="w3-button w3-section w3-green w3-ripple">步驟四</a></h1></div>
	  <div class="w3-col w3-container w3-half"><p>確認PBL討論框架</p></div>
	  <!-- <div class="w3-col w3-container w3-quarter"><p>Unfinished</p></div> -->
	</div>
	
	<!-- Button
	<div class="w3-row">
		<div class="w3-col w3-container"><a href="login.php" class="w3-button w3-section w3-green w3-ripple">back</a>
		<a href="login.php" class="w3-button w3-section w3-green w3-ripple">log out</a></div>
	</div> -->
</div>
  
</div>
  <div class="w3-container">
    <p class="w3-large">Graduate Institute of Digital Learning and Education rakha</p>
    <p>powered by <a href="https://www.gidle.ntust.edu.tw/home.php?Lang=en" target="_blank">GIDLE - NTUST</a></p>
  </div>

</body>
</html>

