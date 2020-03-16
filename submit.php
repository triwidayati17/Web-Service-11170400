<?php
	include("Api.php");
	$customer = new Api();
	$data = json_decode(file_get_contents('php://input'), true);
	echo"<pre>";print_r($data);
	try {
		
		$sql1 = "INSERT INTO room
			(RoomNum,Type,PricePerAdult,PricePerChild,PricePerBase)
			VALUES (
			'".$data["RoomNum"]."',
			'".$data["Type"]."',
			'".$data["PricePerAdult"]."',
			'".$data["PricePerChild"]."',
			'".$data["PricePerBase"]."')";
			
		$customer->conn->query($sql1);
		echo "Successfully";
	}catch(PDOException $e){
	    echo "Failed saving to database : ".$e->getMessage();
	}
?>
			