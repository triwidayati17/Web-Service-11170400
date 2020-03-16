<?php
include("Api.php");
$customer = new Api();
$data = ['RoomNum' => $_GET["RoomNum"],
         'Type' => $_GET["Type"]];
echo $customer->post("http://localhost/api/savecancel.php", $data);
?>