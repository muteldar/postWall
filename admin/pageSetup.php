<?php
require('inc/functions.php');
Admin_Header();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
		<? 
			echo '<title>'. BLOGNAME . ' | ' . 'AdminPanel</title>';
		?>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="./css/spectrum.css">
		<link href="//fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
		<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
		<script type="text/javascript" src="./js/spectrum.js"></script>
		<script type="text/javascript">
			<?php
				echo'
				$(document).ready(function()
				{
					$("#BackgroundColor").spectrum({
						showInput: true,
						preferredFormat: "hex3",
						allowEmpty: false,
						clickoutFiresChange: true
					});
					$("#PostBackgroundColor").spectrum({
						showInput: true,
						preferredFormat: "hex3",
						allowEmpty: true,
						clickoutFiresChange: true
					});
					$("#FontColor").spectrum({
						showInput: true,
						preferredFormat: "hex3",
						allowEmpty: false,
						clickoutFiresChange: true
					});
				});';
			?>
		</script>
		<style>
			form {
				padding: 15px;
			}
			body {
				font-family: "Droid Sans", sans-serif;
				color: #626266;
				background-color: #D3DEDE;
			}
			#CustomCSS {
				resize:none;
			}
		</style>
	</head>
	<body>
		<?php
			$configName = 'pageConfig.php';
			if(file_exists($configName))
			{
				include $configName;
			}
		?>
		<div class="container text-center">
			<p><h1>postWall Page Setup</h1></p>
		</div>
		<div class="container">
			<? Log_Out_Bar(); ?>
			<div class="row">
				<div class="col-md-2">
				<?php Admin_Navbar(basename($_SERVER['PHP_SELF']));  ?>
				</div>
				<div class="col-md-8">
				<?php 
					if(isset($_POST['BlogName'],$_POST['PageTitle'],$_POST['FontSelection'],$_POST['BackgroundColor'],$_POST['PostBackgroundColor'],$_POST['FontColor'],$_POST['SpanSize']))
					{
						if(isset($_POST['CustomCSS']) && $_POST['CustomCSS'] != "")
						{
							$customCSS = 'if (!defined("CUSTOMCSS")) define("CUSTOMCSS", "'. $_POST['CustomCSS'] .'");';
						}
						else
						{
							$customCSS = '';
						}
						$configInfo = 
						'<?php
						if (!defined("BLOGNAME")) define("BLOGNAME", "'. $_POST['BlogName'] .'");
						if (!defined("PAGETITLE")) define("PAGETITLE", "'. $_POST['PageTitle'] .'");
						if (!defined("FONTSELECTION")) define("FONTSELECTION", "'. $_POST['FontSelection'] .'");
						if (!defined("FONTSIZE")) define("FONTSIZE","'. $_POST['FontSize'].'");
						if (!defined("BACKCOLOR")) define("BACKCOLOR", "'. $_POST['BackgroundColor'] .'");
						if (!defined("POSTCOLOR")) define("POSTCOLOR", "'. $_POST['PostBackgroundColor'] .'");
						if (!defined("FONTCOLOR")) define("FONTCOLOR", "'. $_POST['FontColor'] .'");
						if (!defined("SPAN")) define("SPAN", "'. $_POST['SpanSize'] .'");
						'. $customCSS .'
						?>';
						$fileWrite = fopen($configName, "w");
						fwrite($fileWrite, $configInfo);
						fclose($fileWrite);
					}

					echo '
					<div class="Panel Panel-Default">
					<div class="panel-heading"><h3>postWall Settings</h3></div>
					<div class="panel-body">
					<form class="form" role="form" method="post" name="postWallSettingsForm" action="">
					<div class="form-group">
					<label for="BlogName">Blog Name</label>
					<input type="text" class="form-control input-lg" name="BlogName" id="BlogName" value="';
					if(isset($_POST['BlogName'])){ echo $_POST['BlogName']; } else { echo BLOGNAME; }
					echo '"/>
					</div>
					<div class="form-group">
					<label for="PageTitle">Page Title</label>
					<input type="text" class="form-control input-lg" name="PageTitle" id="PageTitle" value="';
					if(isset($_POST['PageTitle'])){ echo $_POST['PageTitle']; } else { echo PAGETITLE; }
					echo '"/>
					</div>';
					//<div class="form-group">
					//<label for="Favicon">Favicon [ Disabled for Now ]</label>
					//<input type="file" name="FavIcon" id="FavIcon" class="form-control input-lg" disabled/>
					//</div>
					echo'
					<div class="form-group">
					<label for="FontSelection">Font-Family</label>
					<select id="FontSelection" name="FontSelection" class="form-control input-lg" >';
					if(isset($_POST['FontSelection'])){ $fontChoice = $_POST['FontSelection']; } else { $fontChoice = FONTSELECTION; }
					$path = 'fonts';
					$fontfile = 'googlefonts.txt';
					$fonts = fopen($path . "/" . $fontfile,"r") or die("Cannot Open" . $fontfile);
					while(!feof($fonts))
					{
						$fontName = fgets($fonts);
						if($fontName == $fontChoice)
						{
							echo '<option value="'. $fontName .'" selected>' . $fontName . '</option>';
						}
						else
						{
							echo '<option value="'. $fontName .'">' . $fontName . '</option>';	
						}
					}
					fclose($fonts);
					echo '	
					</select>
					</div>
					<div class="form-group">
					<label for="FontSize">Default Non-Heading Font Size</label>
					<select id="FontSize" name="FontSize" class="form-control input-lg">';
					if(isset($_POST['FontSize'])){ $fontSize = $_POST['FontSize']; } else { $fontSize = FONTSIZE; }
					for($i = 12; $i <= 36; $i++)
					{
						if($i == $fontSize)
							echo"<option value='". $i ."' selected>". $i ."</option>";
						else
							echo "<option value='". $i ."''>". $i ."</option>";
					}
					echo '</select>
					</div>
					<div>
					<div class="form-group">
					<label for="BackgroundColor">Background Color</label><br/>
					<input type="text" name="BackgroundColor" id="BackgroundColor" value="';
					if(isset($_POST['BackgroundColor'])){ echo $_POST['BackgroundColor']; } else { echo BACKCOLOR; }
					echo '"/>
					</div>
					<div class="form-group">
					<label for="PostBackgroundColor">Post Background Color</label><br/>
					<input type="text" name="PostBackgroundColor" id="PostBackgroundColor" value="';
					if(isset($_POST['PostBackgroundColor'])){ echo $_POST['PostBackgroundColor']; } else { echo POSTCOLOR; }
					echo'"/>
					</div>
					<div class="form-group">
					<label for="FontColor">Font Color</label><br/>
					<input type="text" name="FontColor" id="FontColor" value="';
					if(isset($_POST['FontColor'])){ echo $_POST['FontColor']; } else { echo FONTCOLOR; }
					echo'"/>
					</div>
					</div>
					<div class="form-group">
					<label for="SpanSize">Post Default Span Size</label>
					<select id="SpanSize" name="SpanSize" class="form-control input-lg">';
					if(isset($_POST['SpanSize'])){ $spanSize = $_POST['SpanSize']; } else { $spanSize = SPAN; }
					for($j = 40; $j <= 100; $j += 10)
					{
						if($j == $spanSize)
							echo"<option value='". $j ."%' selected>". $j ."%</option>";
						else
							echo"<option value='". $j ."%'>". $j ."%</option>";
					}
					echo '</select>
					</div>
					<div class="form-group">
					<label for="CustomCSS">Custom CSS</label>
					<textarea class="form-control" id="CustomCSS" name="CustomCSS" rows="10">';
					if(isset($_POST['CustomCSS'])){ echo $_POST['CustomCSS']; } else { if(CUSTOMCSS != "") echo ""; }
					echo'</textarea>
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