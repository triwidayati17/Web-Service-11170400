<?php
include("Api.php");
$customer = new Api();
$data = json_decode(file_get_contents('php://input'), true);
try {

	$sql = "UPDATE room SET
		Type = '".$data["Type"]."',
		PricePerAdult = '".$data["PricePerAdult"]."',
		PricePerChild = '".$data["PricePerChild"]."',
		PricePerBase = '".$data["PricePerBase"]."' 
		WHERE RoomNum ='".$data["RoomNum"]."'";
	$customer->conn->query($sql);
		echo "Successfully. Query : ".$sql;
	}catch(PDOException $e){
		echo "Failed saving to databse : ".$e->getMessage();
	}
?>