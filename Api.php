<?php
class Api{
	
	public $conn;
	
	public function __construct(){
		$servername = "localhost";
		$username = "root";
		$password = "";
		$database = "hotel reservation";
		
		try {
			$this->conn = new PDO ("mysql:host=$servername;dbname=$database",
							$username,$password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}catch(PDOException $e){
			echo "Connection failed : ".$e->getMessage();
		}
		
	
	}
	
	public function get($keyword="",$limit=""){
		$limit = isset($_GET['limit']) ? (int) $_GET['limit'] : 0;
		$name = isset($_GET['name']) ? $_GET['name'] : '';
		
		$sql_limit = (!empty($limit))? 'LIMIT 0,'.$limit :'';
		$sql_name =  (!empty($name))? 'WHERE name LIKE \'%'.$name.'%\'':'';
		
		$sql = "SELECT * FROM customer  ".$sql_name."".$sql_limit;
		$data = $this->conn->prepare($sql);
		$data->execute();
		$customer = [];
		while($row= $data->fetch(PDO::FETCH_OBJ)){
				$customer[]=["CustNum"=>$row->CustNum,
				"Name"=>$row->Name,
				"Address"=>$row->Address,
				"City"=>$row->City,
				"Email"=>$row->Email,
				"Phone"=>$row->Phone];
				
		}
		
		$this->conn = null;
		header('content-Type: application/json');
		
		$arr = array();
		$arr['info'] = 'success';
		$arr['num'] = count($customer);
		$arr['result'] = $customer;
		
		return json_encode(array('ITEMS'=>$arr),JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
	}
	public function post($url,$params){
		$payload = json_encode($params);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' .strlen($payload))
		);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
		
	}
	public function put($url,$params){
		$payload = json_encode($params);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' .strlen($payload))
		);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
		
	}
	public function cancel ($url,$params){
		$payload = json_encode($params);
		$ch = curl_init($url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLINFO_HEADER_OUT, true);
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
		curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array(
			'Content-Type: application/json',
			'Content-Length: ' .strlen($payload))
		);
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
		
	}
} 
?>
		