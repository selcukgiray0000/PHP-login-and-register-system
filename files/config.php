<?php
try
{
$db = new PDO("mysql:host=localhost;dbname=db_333;charset=utf8;", "root", "");
}
catch(PDOException $error)
{
	echo $error->getMessage();
}


if(isset($_SESSION["email"]))
{
	$query = $db->prepare("SELECT * FROM user WHERE email=?");
	$query->execute([$_SESSION["email"]]);
	$number = $query->rowCount();
	$userinfo = $query->fetch(PDO::FETCH_ASSOC);

	if($number > 0)
	{
		$username = $userinfo["username"];
		$email = $userinfo["email"];
		$gender = $userinfo["gender"];
	}
}
?>