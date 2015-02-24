<?php

if(!isset($_SESSION))
{
	session_start();
}

$path = __DIR__ . '/serverConfig.php';

if(file_exists($path))
{
	require($path);
}
else
{

}
require('constants.php');

//============================
// Set TimeZone Default
//
//============================
if (!defined('TIMEZONE'))
{
	date_default_timezone_set('UTC');
}
else
{
	date_default_timezone_set(TIMEZONE);
}

//============================
// Login and set $_SESSION vars.
//
// @param  string   $username Username for login.
// @param  string   $password Password for login.
// @return bool     True for login|False for Not.
//
//============================
function Login ($username, $password)
{
	if ($username == USER && password_verify($password,PASSWORD))
	{
		$_SESSION['username'] = $username;
		$_SESSION['login'] =  TRUE;
		return true;
	}
	else
	{
		Write_Access_Log('Failed');
		return false;
	}
}

//============================
// Check if the $_SESSION vars have been set. Return true if set.
//
// @return bool     True for login|False for Not.
//
//============================
function Login_Check()
{
	if(isset($_SESSION['username']) && isset($_SESSION['login']))
	{
		return true;
	}
	else
	{
		return false;
	}
}

//============================
// Return IP of user
//
// @return string   Return ip from $_SERVER vars.
//
//============================
function Return_Ip()
{
	if (!empty($_SERVER['REMOTE_ADDR'])) {
		$ip = $_SERVER['REMOTE_ADDR'];
	} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	} else {
		$ip = $_SERVER['HTTP_CLIENT_IP'];
	}
	return $ip;
}

//============================
// TBD should be used instead of includes on every page.
//
//============================
function Return_Setting($setting)
{


}

//============================
// echo favicon block
//
//
//============================
function Fav_Icon()
{
	echo '<link rel="icon" type="image/png" href="favicon.ico">';
	/*<link rel="apple-touch-icon" sizes="57x57" href="../apple-touch-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="114x114" href="../apple-touch-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="72x72" href="../apple-touch-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="144x144" href="../apple-touch-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="60x60" href="../apple-touch-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="120x120" href="../apple-touch-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="76x76" href="../apple-touch-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="152x152" href="../apple-touch-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="../apple-touch-icon-180x180.png">
	<link rel="icon" type="image/png" href="../favicon-192x192.png" sizes="192x192">
	<link rel="icon" type="image/png" href="../favicon-160x160.png" sizes="160x160">
	<link rel="icon" type="image/png" href="../favicon-96x96.png" sizes="96x96">
	<link rel="icon" type="image/png" href="../favicon-16x16.png" sizes="16x16">
	<link rel="icon" type="image/png" href="../favicon-32x32.png" sizes="32x32">
	<meta name="msapplication-TileColor" content="#2b5797">
	<meta name="msapplication-TileImage" content="../mstile-144x144.png">'*/
}

//============================
// process login check and includes on adminPanel pages.
//
//
//============================
function Admin_Header()
{
	if(!Login_Check())
	{
		header("location: ". Return_Error("Not Authorized"));
	}
	else
	{
		$config = "PageConfig.php";
		if(file_exists($config))
		{
			require($config);
		}
		else
		{
			require("inc/defaultConfig.php");
		}
	}
}

//============================
// Echo logout bar
//
//
//============================
function Log_Out_Bar()
{
	echo
	'
	<div class="row">
		<div class="col-md-2"></div>
			<div class="titleDiv col-md-8">
				<h3>
					Logged in as '. $_SESSION["username"] .'<p class="pull-right"> <a href="logout.php">logout</a> </p>
				</h3>
			</div>
		<div class="col-md-2"></div>
	</div>
	';
}

//============================
// Return admin navbar
// @param string  Page name.
// Yuck this function stinks and I don't like it.
//
//============================
function Admin_Navbar($page)
{
	if($page == 'index.php')
	{
		echo
		'<ul class="nav nav-pills nav-stacked">
			<li class="active"><a href="index.php">Home</a></li>
			<li><a href="pageSetup.php">Page Setup</a></li>
			<li><a href="adminLog.php">Admin Logs</a></li>
			<li><a href="help.php">help</a></li>
		</ul>';
	}
	elseif ($page == 'pageSetup.php')
	{
		echo
		'<ul class="nav nav-pills nav-stacked">
			<li><a href="index.php">Home</a></li>
			<li class="active"><a href="pageSetup.php">Page Setup</a></li>
			<li><a href="adminLog.php">Admin Logs</a></li>
			<li><a href="help.php">help</a></li>
		</ul>';
	}
	elseif($page == 'adminLog.php')
	{
		echo
		'<ul class="nav nav-pills nav-stacked">
			<li><a href="index.php">Home</a></li>
			<li><a href="pageSetup.php">Page Setup</a></li>
			<li class="active"><a href="adminLog.php">Admin Logs</a></li>
			<li><a href="help.php">help</a></li>
		</ul>';
	}
	elseif($page == 'help.php')
	{
		echo
		'<ul class="nav nav-pills nav-stacked">
			<li><a href="index.php">Home</a></li>
			<li><a href="pageSetup.php">Page Setup</a></li>
			<li><a href="adminLog.php">Admin Logs</a></li>
			<li class="active"><a href="help.php">help</a></li>
		</ul>';
	}
}

//============================
// Validate video ID being passed
//
// @param   string videoID
// @return  bool   if video exists or not
//
//============================
function Validate_Video($videoID)
{
	$youtubeValidate = "http://gdata.youtube.com/feeds/api/videos/";
	$vimeoValidate = "http://vimeo.com/api/v2/video/";

	$videoID = preg_replace('/\s+/', '', $videoID);

	if(is_numeric($videoID))
	{
		$validateCheck = file_get_contents($vimeoValidate.$videoID.".json");
		if(json_decode($validateCheck) != null || !json_decode($validateCheck))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	else
	{
		$validateCheck = file_get_contents($youtubeValidate.$videoID);
		if($validateCheck == "Video not found" || $validateCheck == "Invalid id")
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}

//============================
//
// Echo Entries from json files as html.
// Used for the mainpage.
//
//============================
function Return_Entries()
{
	$path = 'entries';
	$results = scandir($path, 1);
	$i = 0;

	if(count($results) > 3)
	{
		foreach($results as $result)
		{
			if(strpos($result,'.entry') !== false)
			{
				$contents = file_get_contents($path . '/' . $result);
				$obj = json_decode($contents);
				$entries[$i]['date'] = $obj->{"date"};
				$entries[$i]['video'] = $obj->{"video"};
				$entries[$i]['comments'] = $obj->{"comments"};
				$i++;
			}
		}

		$dates = array();

		foreach($entries as $key => $value)
		{
			$dates[$key] = $value['date'];
		}

		array_multisort($dates, SORT_DESC, $entries);

		foreach($entries as $key => $value)
		{
	        echo
	       "<div class='bufferDiv'></div>
	        <div class='entryDiv'>
	            <div class='dateDiv'>" . $value['date'] ."</div>";
	        if(is_numeric($value['video']))
	        {
	        	echo "<iframe src='//player.vimeo.com/video/".$value['video'] ."' width='520' height='415' frameborder='0' webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>";
	        }
	        else
	        {
	        	echo "<div class='youtube' id='" . $value['video'] . "' style='width: 520px; height: 415px;'></div>";
	        	//echo "<iframe width='520' height='415' src='//www.youtube.com/embed/". $value['video'] ."?rel=0' frameborder='0' allowfullscreen></iframe>";
	        }
	        echo
	        "<div class='commentDiv'><p>". $value['comments'] ."</p></div>
	        </div>";
		}
	}
	else
	{
		echo
		 "<div class='bufferDiv'></div>
          <div class='entryDiv'>
          	<div class='dateDiv'>" . date('d-m-y') ."</div>
            <div class='commentDiv'><p>No Entries Yet</p></div>
          </div>";
	}
}

//============================
//
// Echo Entries with Checkboxes for editing.
// Used for the adminpage.
//
//============================
function List_Entries_Admin()
{
	if(login_check())
	{
		$path = '../entries';
		$results = scandir($path, 1);
		natsort($results);
		echo "<form class='form' role='form' method='post' name='removeform' action='inc/removeEntry.php'>";
		echo "<table class='table table-striped table-bordered'>";
		echo
		"<tr>
			<th>Entry Date</th>
			<th>Delete?</th>
		</tr>";
		foreach($results as $result)
		{
			if(strpos($result,'.entry') !== false)
			{
				echo
				"<tr>
					<td>$result</td>
					<td>
						<label class='checkbox-inline'>
							<input type='checkbox' id='$result' value='$result' name='removecheck[]'>
						</label>
					</td>
				</tr>
				";
			}
		}
		echo "</table>";
		echo "<button type='submit' class='btn btn-lg'>Remove Checked Entries</button>";
		echo "</form>";
	}
}

//============================
// Check if an Entry exists. Depreciated but here none the less.
//
// @param  string   $date date as string (probably should be DATETIME) to find entry.
// @return bool     true if entry is found | false if not.
//
//============================
function Check_For_Entry($date)
{
	$path = '../../entries';
	$results = scandir($path, 1);
	foreach($results as $result)
	{
		if(strpos($result,'.entry') !== false)
		{
			$dateextract = explode(".", $result);
			if($dateextract[0] == $date)
			{
				return true;
			}
		}
	}
	return false;
}

//============================
// Write to the Access Log to track Access to the AdminPanel.
//
// @param  string   $attempt Type of attempt (Failed/Succeded).
// @return bool     true if file was written | false if not.
//
//============================
function Write_Access_Log($attempt)
{
	$accessAttempt = date("Y-m-d H:i:s"). ' [' . $attempt . ' Access Attempt] IP : ' .Return_Ip(). "\n";
	$fileWrite = fopen(ACCESSLOG, "a+");
	if($fileWrite === false)
	{
		return false;
	}
	else
	{
		if(fwrite($fileWrite, $accessAttempt) === false)
		{
			return false;
		}
		fclose($fileWrite);
		return true;
	}
}

//============================
// Write to the Admin Log to track Admin usage.
//
// @param string   $action Type of action (Added/Removed).
//
//============================
function Write_Admin_Log($action)
{
	$adminAction = date("Y-m-d H:i:s"). ' [Admin ' . $action . ' Action] IP : ' .Return_Ip(). "\n";
	$fileWrite = fopen(adminLog, "a+");
	fwrite($fileWrite, $adminAction);
	fclose($fileWrite);
}

//============================
// Echo each logline from the provided log
//
// @param string   $log Log to be returned.
//
//============================
function Return_Log_Lines($log)
{
	if(Login_Check())
	{
		if(file_exists($log))
		{
			$loglines = file($log);
			if($loglines != null)
			{
				foreach($loglines as $logline)
				{
					echo $logline. '</br>';
				}
			}
			else
			{
				echo "No Log Found";
			}
		}
		else
			echo "No Log Found";
	}
}

//============================
// Return Error Page.
//
// @param  string   $error Error text to display on the error page.
// @return string   $return Error Constructed page with url parameter set to $error.
//
//============================
function Return_Error($error)
{
	$path = '../Error.php';
	$returnError = $path. "?err=". $error;
	return $returnError;
}

//============================
// Add postWall Entry.
//
// @param  string   $date date as string (probably should be DATETIME) to append to entry.
// @param  string   $videohash videohash used to embed video.
// @param  string   $comments additional comments.
// @return bool     true if file is created | false if not.
//
//============================
function Add_Entry($date, $videoID, $comments)
{
	$path = '../../entries';

	$videoID = preg_replace('/\s+/', '', $videoID);

	$content = '{"date":"'.$date.'","video":"'.$videoID.'","comments":"'.$comments.'"}';
	$timeHash = substr(md5(date('H:i:s')),0,5);
	$file = "$path/$date-". $timeHash .".entry";


	if(file_put_contents($file, $content) === false)
	{
		return false;
	}
	else
	{
		Write_Admin_Log('Added');
		return true;
	}
}

//============================
// Remove an entry if it exists.
//
// @param  string   $file file to unlink.
// @return bool     true if file is unlinked | false if not.
//
//============================
function Remove_Entry($file)
{
	$path = '../../entries';
	$results = scandir($path, 1);
	foreach($results as $result)
	{
		if(strpos($result,'.entry') !== false)
		{
			if($result === $file)
			{
				unlink("$path/$result");
				Write_Admin_Log('Removed');
			}
		}
	}
}
?>
