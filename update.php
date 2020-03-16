<?php
include ("Api.php");
$customer = new Api();
$data = ['RoomNum'=> $_GET["RoomNum"],
		'Type'=> $_GET["Type"],
		'PricePerAdult'=> $_GET["PricePerAdult"],
		'PricePerChild'=> $_GET["PricePerChild"],
		'PricePerBase'=> $_GET["PricePerBase"]];
echo $customer->put("http://localhost/api/saveupdate.php", $data);
 ?>