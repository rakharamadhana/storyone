<?php
//update.php
$connect = mysqli_connect("localhost", "taipei", "taipei@2022@", "dst_db");
//$page_id = $_POST["page_id_array"];
for($i=0; $i<count($_POST["page_id_array"]); $i++)
{
 $query = "
 UPDATE reflect2 
 SET pilih = '".$i."' 
 WHERE id = '".$_POST["page_id_array"][$i]."'";
 mysqli_query($connect, $query);
}
echo 'Page Order has been updated'; 

?>
