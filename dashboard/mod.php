<?php 

	require_once('../lib/config.php'); 

	//Template debugging mode enable based on $_GET['template']
	if (isset($_GET['template']) && ($_GET['template'] == true)){
		//Override SITE variable to use templated trackerV2 instead
		require_once('../lib/classes/trackerV2.class.php');
		$siteV2 = new TrackerV2;
		$siteV2->name = "BT Debug";
		$siteV2->description = "in ur internets, trackin ur fookups";
		$siteV2->url = "http://labs.ryanpriebe.com/bonecrusher/";
		$siteV2->homedir = "/home/vistyle/labs/bonecrusher/";
		$smarty->assign("debug_tpl",true);
		$smarty->clearAssign("site");
		$smarty->assign("site",$siteV2);
	}

	if(!isset($_SESSION["user_name"]) || !($user->is_mod() || $user->is_admin())){
	
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
					
						$_GET['type'] = "modbugs";
					
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