<?php
include_once("conn.php");
date_default_timezone_set("Asia/Bangkok");
$query="SELECT id_booking, nama_dipesan FROM booking LEFT JOIN meja ON booking.no_meja_fk = meja.no_meja WHERE booking.no_meja_fk=2;";
$reserve_details=$GLOBALS['conn']->query($query)->fetch();
return $reserve_details;
?>