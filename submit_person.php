<?php
$host = "localhost";
$db_name = "testdb";
$username = "root";
$password = "Linux4Ever!";
$connection = null;
try{
	$connection = new PDO("mysql:host=" . $host . ";dbname=" . $db_name, $username, $password);
	$connection->exec("set names utf8");
	}catch(PDOException $exception){
		echo "Connection error: " . $exception->getMessage();
}
	function saveData($name, $email, $role){
	global $connection;
	$query = "INSERT INTO test(name, email, role) VALUES( :name, :email, :role)";

	$callToDb = $connection->prepare( $query );
	$name=htmlspecialchars(strip_tags($name));
	$email=htmlspecialchars(strip_tags($email));
	$role=htmlspecialchars(strip_tags($role));
	$callToDb->bindParam(":name",$name);
	$callToDb->bindParam(":email",$email);
	$callToDb->bindParam(":role",$role);
		if($callToDb->execute()){
		return '<h3 style="text-align:center;">Data sent to database!</h3>';
	}
}

if( isset($_POST['submit'])){
	$name = htmlentities($_POST['name']);
	$email = htmlentities($_POST['email']);
	$role = htmlentities($_POST['role']);

	//then you can use them in a PHP function. 
	$result = saveData($name, $email, $role);
	echo $result;
	}
else{
	echo '<h3 style="text-align:center;">Error ( ͡° ͜ʖ ͡°)</h3>';
}
?>
