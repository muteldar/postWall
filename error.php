<?php
$error = filter_input(INPUT_GET, 'err', $filter = FILTER_SANITIZE_STRING);

if(! $error)
{
	$error = 'Sorry! There was an Unknown Error.';
}
?>
<html>
	<head>
		<?php
			$config = getcwd(). '/admin/PageConfig.php';
			if(file_exists($config))
			{
				include_once $config;
			}
			else
			{
				include_once getcwd().'/admin/inc/defaultConfig.php';
			}
		?>
		<meta charset="utf-8">
		<title>Uh Oh!</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<?php
			echo '<link href="http://fonts.googleapis.com/css?family=' . FONTSELECTION .'"';
			echo ' rel="stylesheet" type="text/css">';;
		?>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<style>
			body{
				font-family: "Droid Sans", sans-serif;
				color: #626266;
				background-color: #D3DEDE;
			}
			#error{
				padding-top: 20px;
			}
		</style>
	</head>
	<body>
		<div class="row" id="error">
			<div class="col-md-2"></div>
			<div class="col-md-8">
				<div class="Panel Panel-Default">
					<div class="panel-heading">
						<h1>Uh Oh there has been an Error!</h1>
					</div>
					<div class="panel-body">
						<h2><?php echo $error; ?></h2>
					</div>
				</div>
			</div>
			<div class="col-md-2"></div>
		</div>
	</body>
</html>
