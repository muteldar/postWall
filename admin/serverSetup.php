<html>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<style>
			form {
				padding: 15px;
			}
			body {
				font-family: "Droid Sans";
				color: #626266;
				background-color: #D3DEDE;
			}
		</style>
	</head>
	<body>
		<div class="container text-center">
			<p><h1>postWall Server Setup</h1></p>
			<h1><small>postWall server side settings</small></h1>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
				<?php 
					$configName = 'serverConfig.php';

					if(file_exists($configName))
					{
						echo '<div class="text-center"><h2><p class="text-success">Config File Has Been Created!</p>
						<p class="text-danger"> Make sure to delete serverSetup.php to keep your settings secure</p></h2></div>';
						require($configName);
					}

					if(isset($_POST['TimeZoneSelect'],$_POST['AdminUser'],$_POST['AdminPass']))
					{
						$salt = bin2hex(mcrypt_create_iv(60, MCRYPT_DEV_URANDOM));
						$configInfo = 
						'<?php 
						define("TIMEZONE", "'. $_POST['TimeZoneSelect'] .'");
						define("USER", "'. $_POST['AdminUser'] .'");
						define("PASSWORD", "'. crypt($_POST['AdminPass'], $salt) .'");
						define("SALT", "'. $salt .'");
						?>';
						$fileWrite = fopen($configName, "w");
						fwrite($fileWrite, $configInfo);
						fclose($fileWrite);
					}
					
					echo '
					<div class="Panel Panel-Default">
					<div class="panel-heading"><h3>Server Settings</h3></div>
					<div class="panel-body">
					<form class="form" role="form" method="post" name="ServerSettingsForm" action="">
					<div class="form-group">
					<label for="TimeZoneSelect">Time Zone Select</label>
					<select id="TimeZoneSelect" class="form-control input-lg" name="TimeZoneSelect">';
					$timezones = DateTimeZone::listIdentifiers(DateTimeZone::ALL);
					foreach($timezones as $zone)
					{
						echo '<option>'.$zone.'</option> ';
					}									
					echo'
					</select>
					</div>
					<div class="form-group">
					<label for="AdminUser">Admin Username</label>
					<input type="text" class="form-control input-lg" name="AdminUser" id="AdminUser" value="';
					if(isset($_POST['AdminUser'])){ echo $_POST['AdminUser']; }
					echo '"/>
					</div>
					<div class="form-group">
					<label for="AdminPass">Admin Password</label>
					<input type="password" class="form-control input-lg" name="AdminPass" id="AdminPass" value="';
					if(isset($_POST['AdminPass'])){ echo $_POST['AdminPass']; }
					echo '"/>
					</div>
					<button type="submit" name="submit" value="submit" class="btn btn-default">Submit</button>
					</form>
					</div>
					</div>';
				?>
				</div>
			</div>
		</div>
		<div class="col-md-2"></div>
	</body>
</html>