<?php
if(!isset($_SESSION))
{
	session_start();
}
require('inc/functions.php');
$config = 'pageConfig.php';
if(file_exists($config))
{
	include_once $config;
}
else
{
	include_once 'inc/defaultConfig.php';
}

if(Login_Check())
{
	echo'
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
			<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=Edge" />';
			echo '<title>'. BLOGNAME . ' | ' . 'AdminPanel</title>';
			Fav_Icon();
			echo '
			<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
			<link href="//fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
			<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
			<link rel="stylesheet" type="text/css" href="css/datepicker.css">
			<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
			<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/bootstrap-datepicker.js"></script>
			<script>
					$(function(){
								$("#datepicker").datepicker({format: "mm-dd-yyyy"});
					});
			</script>
			<style>
					body{
						font-family: "Droid Sans", sans-serif;
						color: #626266;
						background-color: #D3DEDE;
					}
					#comments{
						resize:none;
					}
					A:link {text-decoration: none;}
					A:visited {text-decoration: none;}
					A:active {text-decoration: none;}
					A:hover {color: gray;}
			</style>
		</head>
	    <body>
    		<div class="container text-center">
				<p><h1>postWall AdminPanel</h1></p>
			</div>
	    	<div class="container">
				';
				Log_Out_Bar();
				echo '
				<div class="row">
					<div class="col-md-2">
					'; 
					Admin_Navbar(basename($_SERVER['PHP_SELF']));
					echo '
					</div>
					<div class="col-md-8">
						<div class="Panel Panel-Default">
							<div class="panel-heading"><h3>Add Entry</h3></div>
							<div class="panel-body">
								<form class="form" role="form" method="post" name="addform" action="inc/addentry.php">
									<div class="form-group">
										<label for="datetime">Set Date</label>
										<input type="text" class="form-control input-lg" value="" data-date-format="mm-dd-yyyy" name="datepicker" id="datepicker">
									</div>
									<div class="form-group">
										<label for="video">Video ID <small>Youtube example: DoLAoOkG5gY or Vimeo example: 54577007</small></label>
										<input type="text" class="form-control input-lg" id="videoid" name="videoid">
									</div>
									<div class="form-group">
										<label for="comments">Comments</label>
										<textarea class="form-control" id="comments" name="comments" rows="5"></textarea>
									</div>
									<button type="submit" name="submit" value="submit" class="btn btn-default btn-lg">Submit</button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-md-2"></div>
				</div>
				<div class="row">
					<div class="col-md-2"></div>
					<div class="col-md-8">
					<div class="Panel Panel-Default">
					<div class="panel-heading"><h3>Existing Entries</h3></div>
					<div class="panel-body">';
					List_Entries_Admin();
				echo'
					</div>
					</div>
					</div>
					<div class="col-md-2"></div>
				</div>
			</div>
		</body>
	</html>';
}
else
{
    echo
    '<html>
        <head>
    		<meta charset="utf-8">
			<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
            <title>';
			echo BLOGNAME . ' | ' . 'AdminPanel';
			Fav_Icon();
			echo '</title>
			<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
			<link href="//fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet" type="text/css">
			<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet">
            <style>
				body{
					font-family: "Droid Sans", sans-serif;
					color: #626266;
					background-color: #D3DEDE;
				}
				.titleDiv {
					font-family: "Droid Sans", sans-serif;
				}
            </style>
        </head>
        <body>
        	<div class="container text-center">
				<p><h1>postWall Login</h1></p>
			</div>
        	<div class="container">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-8">
						<div class="Panel Panel-Default">
							<div class="panel-heading"><h3>Admin Login</h3></div>
							<div class="panel-body">
								<form class="form-inline" role="form" method="post" action="inc/process_login.php">
		                            <div class="form-group">
		                                <label class="sr-only" for="username">User Name</label>
		                            	<div class="controls">
		                            		<div class="input-prepend">
		                                		<input type="text" class="form-control input-lg" id="username" name="username" placeholder="Enter User Name">
		                                	</div>
		                                </div>
		                            </div>
		                            <div class="control-group form-group">
		                            	<label class="sr-only" for="pass">Password</label>
		                            	<div class="controls">
		                            		<div class="input-prepend">
				                                <input type="password" class="form-control input-lg" id="password" name="password" placeholder="Enter Password">
				                            </div>
		                                </div>
		                            </div>
		                            <button type="submit" name="submit" value="submit" class="btn btn-default btn-lg">Sign In</button>
		                        </form>
		                    </div>
						</div>
					</div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </body>
    </html>';
}
?>