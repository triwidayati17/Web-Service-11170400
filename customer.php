<?php
	include("Api.php");
	$limit	= isset($_GET['limit'])? (int) $_GET['limit']: 0;
	$keyword = isset($_GET['name'])? $_GET['name']:'';
	$customer = new Api();
	echo $customer->get($keyword,$limit);
?>