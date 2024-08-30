<?php  
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

// memanggil functions.php
require 'functions.php';

$userid = $_SESSION["userId"];
$tools = query("SELECT * FROM tools_desc WHERE user = '$userid' ORDER BY pilih ASC");

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
	  <div class="w3-col w3-container w3-xxlarge"><h1>階段一 - 步驟四 : 確認PBL討論框架</a></h1></div>
	</div>
	<div class="w3-row">
	    <div class="w3-col w3-container"><p>想法-問題應該如何解決？</p></div>
        <div class="w3-col w3-container"><p>事實-知道什麼問題相關的事實？</p></div>
        <div class="w3-col w3-container"><p>學習論題-要解決問題還需要知道什麼？</p></div>
        <div class="w3-col w3-container"><p>行動計畫-如何尋找解決問題方法的資料？</p></div>
	</div>

<!-- Looping for the div table -->
<?php $i = 1; ?>	
<?php foreach ( $tools as $row ) : ?>
		<!-- Looping for change colour div -->
		<?php if ( $i % 2 == 0 ) : ?>
			<div class="w3-row w3-light-green">
			<?php else : ?>
			<div class="w3-row w3-lime">	
		<?php endif; ?>
		<!-- End div -->
	  <div class="w3-col w3-container w3-xxlarge w3-quarter"><h1>工具 <!-- <?= $i; ?> --> :</h1></div>
	  <div class="w3-col w3-container w3-half"><p><?= $row["nama"]; ?></p></div>
	  <div class="w3-col w3-container w3-quarter"><a href="phase_1_1_step4_edit.php?id=<?= $row["id"]; ?>" class="w3-button w3-section w3-green w3-ripple"><i class='fas fa-edit' style='font-size:24px'></i></a><a href="phase_1_1_step4_delete.php?id=<?= $row["id"]; ?>" onclick="return confirm('Do you want to delete?');" class="w3-button w3-section w3-green w3-ripple"><i class='fas fa-trash-alt' style='font-size:24px'></i></a></div>
	</div>

<?php $i++; ?>
<?php endforeach; ?>	
<!-- End looping for the div table -->

	<div class="w3-row">
		<div class="w3-col w3-container">
		<a href="phase_1_1_step4_addtools.php" class="w3-button w3-section w3-green w3-ripple">Add tools (新增工具)</a><!-- <a href="phase_1_1_step4_changeorder.php" class="w3-button w3-section w3-green w3-ripple">Change order</a> --> &nbsp<a href="phase_1_1_step3.php" class="w3-button w3-section w3-green w3-ripple"><i class='fas fa-chevron-left'></i></a></div>
	</div> 
</div>
  
</div>

  <div class="w3-container">
    <p class="w3-large">Graduate Institute of Digital Learning and Education</p>
    <p>powered by <a href="https://www.gidle.ntust.edu.tw/home.php?Lang=en" target="_blank">GIDLE - NTUST</a></p>
  </div>

</body>
</html>