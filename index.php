<!-- 
		Built with/by 
			n00bworks http://www.n00bworks.com/
			Twitter bootstrap http://getbootstrap.com/
			Spectrum http://bgrins.github.io/spectrum/
			bootstrap-datepicker http://www.eyecon.ro/bootstrap-datepicker/
-->
<?php
	require('admin/inc/Functions.php');
	$config = 'admin/PageConfig.php';
	if(file_exists($config))
	{
		require($config);
	}
	else
	{
		require('admin/inc/DefaultConfig.php');
	}
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<title><?php echo BLOGNAME . ' | ' . PAGETITLE; ?></title>	
		<?php
			echo '<link href="http://fonts.googleapis.com/css?family=' . FONTSELECTION .'"';
			echo ' rel="stylesheet" type="text/css">';
			Fav_Icon();
		?>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://labnol.googlecode.com/files/youtube.js"></script>
		<meta name="description" content="<?php echo BLOGNAME . ' | ' . PAGETITLE; ?>"/>
		<meta name="keywords" content=""/>
		<style>
			body {
				margin: 0px;
				width: 100%;
				font-family: <?php echo FONTSELECTION; ?>;
				color: <?php echo FONTCOLOR;  ?>;
				background-color: <?php echo BACKCOLOR;?>;
				padding-top: 15px;
			}
			.titleDiv {
				background-color: <?php echo POSTCOLOR; ?>;
				width: 550px;
				padding-top: 15px;
				padding-left: 10px;
				padding-bottom: 15px;
			}
			.bufferDiv {
				height: 100px;
			}
			.dateDiv {
				padding-top: 10px;
				padding-bottom: 10px;
				font-size: <?php echo FONTSIZE."px"?>;
			}
			.commentDiv {
				padding-left: 10px;
				padding-right: 10px;
				font-size: <?php echo FONTSIZE."px"?>;
				word-wrap: break-word;
			}
			.entryDiv{ 
				width: <?php echo SPAN; ?>;
				background-color: <?php echo POSTCOLOR; ?>;
				padding: 20px;
				text-align: center;
				margin:0 auto;
			}
			.footerDiv{
				width 100%;
				padding-top: 20px;
				padding-bottom: 20px;
				text-align: center;
				font-size: 14px;
				font-weight: bold;
			}
			<?php
				if(!defined(CUSTOMCSS))
				{
					echo '';
				}
				else
				{
					if(CUSTOMCSS != null && CUSTOMCSS != 'CUSTOMCSS')
					{
						echo CUSTOMCSS;
					}
				}
			?>
		</style>
	</head>
	<body>
		<div class='titleDiv'>
			<h1>
				<?php echo BLOGNAME.' '; ?>
			</h1>
		</div>
		<?php Return_Entries(); ?>
		<div class='bufferDiv'></div>
	</body>
	<footer>
	<div class='footerDiv'>
		<?php
		echo BLOGNAME.' '; 
		echo date('Y'); 
		?>
	</div>
	</footer>
</html>