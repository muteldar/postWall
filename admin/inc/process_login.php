<?php
require('functions.php');
if(isset($_POST['username'], $_POST['password']))
{
	$username = $_POST['username'];
	$password = $_POST['password'];
	if(Login($username, $password) == true)
	{
		header('location: ../index.php');
	}
	else
	{
		header('location: ../../error.php?err=Username or Password is Incorrect');
	}
}
else
{
	echo 'Invalid Request';
}
?>