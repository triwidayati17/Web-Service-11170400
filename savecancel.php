<?php
include("Api.php");
$customer = new Api();
$data = json_decode(file_get_contents('php://input'), true);
try {

	$sql = "DELETE FROM room WHERE
			RoomNum = '".$data["RoomNum"]."'
			AND Type = '".$data["Type"]."' ";
	$customer->conn->query($sql);
		echo "Successfully. Query : ".$sql;
	}catch(PDOException $e){
		echo "Failed saving to databse : ".$e->getMessage();
	}
?>