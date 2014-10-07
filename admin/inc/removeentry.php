<?php
if(!isset($_SESSION))
{
	session_start();
}

require('functions.php');

if(Login_Check())
{
	if(isset($_POST['removecheck']))
	{
		foreach($_POST['removecheck'] as $checkbox)
		{
			 Remove_Entry($checkbox);
		}
		header('location: ../index.php');
	}
	else
	{
		header('location: ../index.php');
	}
}
else
{
	header('location: ../../error.php?err=Invalid Request');
}
?>