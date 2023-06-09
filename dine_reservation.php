<?php include_once("conn.php");
$targeted_id = $_GET["table_id"];
$query="UPDATE `meja` SET `status_meja` = '3' WHERE `meja`.`no_meja` = $targeted_id";
$dine_exec=$conn->query($query);
header("location:$_SERVER[HTTP_REFERER]");
?>