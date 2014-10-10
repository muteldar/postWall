<?php
	require('inc/functions.php');
	Admin_Header();
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
		</style>
	</head>
	<body>
		<div class="container text-center">
			<p><h1>postWall Help Page</h1></p>
		</div>
		<div class="container">
			<? Log_Out_Bar(); ?>
			<div class="row">
					<div class="col-md-2">
						<?php Admin_Navbar(basename($_SERVER['PHP_SELF'])); ?>
					</div>
					<div class="col-md-8">
						<div class="Panel Panel-Default">
							<div class="panel-heading"><h3>postWall FAQ</h3></div>
							<div class="panel-body">
							<h4>How do I change my password?</h4>
							<p>Pull another copy of the serverSetup.php page from GitHub and repassword yoursite.</p>
							<h4>How do I edit existing entries?</h4>
							<p>Right now you dont really I should be adding a simple editing feature in future releases. If you really want to you can manually edit the JSON of the specific entry you want to edit.</p>
							<h4>What customization can I do?</h4>
							<p>Right now the custom CSS field will add whatever CSS you provide to the main index page(the one that renders the blog). Feel free to also edit the styles themselves for the Admin Pages.</p>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>	
			</div>
		</div>
	</body>
</html>
