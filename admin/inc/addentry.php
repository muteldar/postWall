<?php
session_start();
include_once 'functions.php';

if(Login_Check())
{
		if(isset($_POST['datepicker'], $_POST['videoid']) && $_POST['datepicker'] != '' && $_POST['videoid'] != '')
		{
			$date = $_POST['datepicker'];
			$videohash = $_POST['videoid'];
			if(Validate_Video($videohash))
			{
				if(isset($_POST['comments']) && $_POST['comments'] != '')
					$comments = str_replace('"', '\"', $_POST['comments']) ;
				else
					$comments = '';
				if(Add_Entry($date, $videohash, $comments) === false)
				{
					header('location: ../../error.php?err=Entry Not Created');
				}
				else
				{
					header('location: ../index.php');
				}
			}
			else
			{
				header('location: ../../error.php?err=Entry Not Created Invalid Video ID');
			}
		}
		else
		{
			header('location: ../../error.php?err=Date or VideoHash has not been set properly');
		}
}
else
{
	header('location: ../../error.php?err=Invalid Request');
}
?>
