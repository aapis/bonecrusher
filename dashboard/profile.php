<?php 

	require_once('../lib/config.php'); 

	if(!isset($_SESSION["user_name"])){
	
		header("Location:index.php");
	
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?= $site->DisplayPageTitle(); ?></title>
		<link rel="stylesheet" href="<?= $site->url; ?>css/<?= $site->ParseTheme($site->theme); ?>" />
		<script type="text/javascript" src="<?= $site->url; ?>js/scripts.js"></script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
					
				<h1 id="title"><a href="<?= $site->url; ?>"><?= $site->name; ?></a></h1>
				<span id="description"><?= $site->description; ?></span>
				
				<?php include("../lib/includes/adminmenu.php"); ?>
			
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
				
				<?php
				
					if(!isset($_GET['type'])){
					
						$_GET['type'] = "editprofile";
					
					}
					
					$site->ModLoad(); 
				
				?>
								
			</div>
			<div id="footer">
			
				<?= $site->DisplayFooter(); ?>
			
			</div>
			
		</div>
		
	</body>
</html>