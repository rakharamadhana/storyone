<?php
//update.php
$connect = mysqli_connect("localhost", "u6421687_storyone", "u6421687_storyone", "u6421687_storyone");
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
