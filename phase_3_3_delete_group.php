<?php 
session_start();

if ( !isset($_SESSION["login"]) ) {
	header("Location: login.php");
	exit;
}

require 'functions.php';
// tangkap id dahulu
$id = $_GET["id"];

if ( hapusgroup($id) > 0 ) {
	echo "
			<script>
			alert('The discussion has been deleted!');
			document.location.href = 'phase_3_3_group.php';
			</script>
		";
} else {
	echo "
			<script>
			alert('The discussion can't be deleted!');
			document.location.href = 'phase_3_3_group.php';
			</script>
		";
}




 ?>