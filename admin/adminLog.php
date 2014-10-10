<?php
require('inc/functions.php');
Admin_Header();

if(isset($_POST['deleteAccess']))
{
	if(file_exists(ACCESSLOG))
	{
		unlink(ACCESSLOG);
	}
}
elseif(isset($_POST['deleteAdmin']))
{
	if(file_exists(ADMINLOG))
	{
		unlink(ADMINLOG);
	}
}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<?php 
			echo '<title>'. BLOGNAME . ' | ' . 'AdminPanel</title>';
		?>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link href="//fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
		<style>
			form {
				padding: 15px;
			}
			body {
				font-family: "Droid Sans", sans-serif;
				color: #626266;
				background-color: #D3DEDE;
			}
			form {
				padding: 0px;
			}
			.panel-body{
				overflow: auto;
				height: 300px;
			}
		</style>
	</head>
	<body>
		<div class="container text-center">
			<p><h1>postWall Admin Logs</h1></p>
		</div>
		<div class="container">
			<? Log_Out_Bar(); ?>
			<div class="row">
				<div class="col-md-2">
					<?php Admin_Navbar(basename($_SERVER['PHP_SELF'])); ?>
				</div>
				<div class="col-md-8">
					<form class="form" role="form" method="post" name="deleteAccessForm" action="">
						<div class="Panel Panel-Default">
									<div class="panel-heading clearfix">
										<h3 class="pull-left">Access Logs</h3>
										<div class="pull-right" style="padding-top: 15px;">
											<button type='submit' class='btn btn-default' name="deleteAccess" value="deleteAccess">Clear Log</button>
										</div>
									</div>
							<div class="panel-body">
								<?php Return_Log_Lines(ACCESSLOG); ?>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
			<div class="row">
				<div class="col-md-2"></div>
				<div class="col-md-8">
					<form class="form" role="form" method="post" name="deleteAdminForm" action="">
						<div class="Panel Panel-Default">
							<div class="panel-heading clearfix">
								<h3 class="pull-left">Admin Logs</h3>
								<div class="pull-right" style="padding-top: 15px;">
									<button type='submit' class='btn btn-default' name="deleteAdmin" value="deleteAdmin">Clear Log</button>
								</div>
							</div>
							<div class="panel-body">
								<?php Return_Log_Lines(ADMINLOG); ?>
							</div>
						</div>
					</form>
				</div>
				<div class="col-md-2"></div>
			</div>
			</form>
		</div>
	</body>
</html>
