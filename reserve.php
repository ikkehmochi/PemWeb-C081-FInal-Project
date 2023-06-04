<?php include_once("conn.php");
$targeted_id = $_GET["table_id"];
$query="UPDATE `meja` SET `status_meja` = '2' WHERE `meja`.`no_meja` = $targeted_id";
$reserve_exec=$conn->query($query);
header("location:tables.php");
?>