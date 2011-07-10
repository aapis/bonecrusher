<?php

	//error_reporting(0);
	
	//basic db definitions
	
	define("DB_USER", "vistyle");
	define("DB_PASSWORD", "ksehjfyhseb");
	define("DB_HOST", "ryanpriebe-projtrkr.ryanpriebe.com");
	define("DB_NAME", "vistyle_projtrkr");
	
	//classes
	
	require_once("classes/db.class.php");
	require_once("classes/tracker.class.php");
	require_once("classes/sessions.class.php");
	require_once("classes/user.class.php");
	require_once("classes/messagecenter.class.php");
	require_once("classes/security.class.php");
	require_once("smarty/Smarty.class.php");
	require_once("classes/smartysetup.class.php");
	require_once("includes/nbbc.php");
	
	//init some classes
	
	$db = new Database(DB_USER, DB_PASSWORD, DB_HOST, DB_NAME);
	$site = new Tracker;
	$user = new User;
	
	//set some defaults
	
	$site->name = "Bug Tracker";
	$site->description = "in ur internets, trackin ur fookups";
	$site->url = "http://labs.ryanpriebe.com/bonecrusher/";
	$site->homedir = "/home/vistyle/labs/bonecrusher/";
	
	if(!$user->id()){
	
		session_start();
		$user->storage->session_defaults();
	
	}
	
	$user->db_name = "trkr";
	//$user->test();
	 
	if($user->logged()){
	//if($this->theme()){
	
		$site->theme = $user->theme();
	
	}else {
	
		$site->theme = $user->storage->get("defaulttheme");
	
	}
	
	//stuff to do onload
	
	$site->ProcessRequest();
	$site->UpdateUserCompletedBugs();
	
	//Init Smarty Template System
	
	$smarty = new Smarty_Setup;
	
?>