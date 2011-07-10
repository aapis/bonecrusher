<?php 
	require_once('lib/config.php');
	
	$page_title = $site->DisplayPageTitle();
	$css_path = $site->url."css/".$site->ParseTheme($site->theme);
	$script_path = $site->url."js/scripts.js";
	
	$smarty->assign("page_title",$page_title);
	$smarty->assign("css_path",$css_path);
	$smarty->assign("script_path",$script_path);
	$smarty->assign("site",$site);
	$smarty->assign("user",$user);
	$smarty->assign("get",$_GET);
	
	//Template debugging mode enable based on $_GET['template']
	if (isset($_GET['template']) && ($_GET['template'] == true)){
		//Override SITE variable to use templated trackerV2 instead
		require_once('lib/classes/trackerV2.class.php');
		$siteV2 = new TrackerV2;
		$siteV2->name = "BT Debug";
		$siteV2->description = "in ur internets, trackin ur fookups";
		$siteV2->url = "http://labs.ryanpriebe.com/bonecrusher/";
		$siteV2->homedir = "/home/vistyle/labs/bonecrusher/";
		$smarty->assign("debug_tpl",true);
		$smarty->clearAssign("site");
		$smarty->assign("site",$siteV2);
	}
	
	$smarty->display('bug.tpl'); 
?>