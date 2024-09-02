<?php
//update.php
require 'functions.php';

$servername = $_ENV['DB_SERVER'];
$username = $_ENV['DB_USERNAME'];
$password = $_ENV['DB_PASSWORD'];
$database = $_ENV['DB_DATABASE'];

$connect = mysqli_connect($servername, $username, $password, $database);
//$page_id = $_POST["page_id_array"];
for($i=0; $i<count($_POST["page_id_array"]); $i++)
{
 $query = "
 UPDATE theme 
 SET pilih = '".$i."' 
 WHERE id = '".$_POST["page_id_array"][$i]."'";
 mysqli_query($connect, $query);
}
echo 'Page Order has been updated'; 

?>
