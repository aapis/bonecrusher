<?php require_once('../lib/config.php'); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?= $site->name; ?></title>
		<link rel="stylesheet" href="<?= $site->url; ?>css/<?= $site->ParseTheme($site->theme); ?>" />
		<script type="text/javascript" src="<?= $site->url; ?>js/scripts.js"></script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
					
				<h1 id="title"><a href="<?= $site->url; ?>"><?= $site->name; ?></a></h1>
				<span id="description"><?= $site->description; ?></span>
								
				<?php 
					
					if($user->group() === 1){
						
						include("../lib/includes/adminmenu.php");
					
					}else {
					
						echo "<h2>Login to ". $site->name ."</h2>";?>
						
						<ul id="tertiarynav">
						
							<li><a href="<?= $site->url; ?>">Home</a></li>
							<li><a href="<?= $site->url; ?>dashboard/index.php?do=login">Login</a></li>
							<?php if($site->storage->get("registration")){?>
								<li><a href="<?= $site->url; ?>dashboard/index.php?do=register">Register</a></li>							
							<?php }?>
						
						</ul>
						
					<?php }
				?>
			
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
				
				<?php
				
					if($user->logged()){
					
						header("Location:content.php");
					
					}else {
					
						$user->LoginInterface();
					
					}
				
				?>
				
			</div>
			<div id="footer">
			
				<?= $site->DisplayFooter(); ?>
			
			</div>
			
		</div>
		
	</body>
</html>