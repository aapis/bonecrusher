<?php

	class Smarty_Setup extends Smarty {
	
	   function __construct()
	   {
	
	        // Class Constructor.
	        // These automatically get set with each new instance.
	
	        parent::__construct();
	
	        $this->template_dir = '/home/vistyle/labs/bonecrusher/templates/';
	        $this->compile_dir  = '/home/vistyle/labs/bonecrusher/templates_c/';
	        $this->config_dir   = '/home/vistyle/labs/bonecrusher/configs/';
	        $this->cache_dir    = '/home/vistyle/labs/bonecrusher/cache/';
	
			//Following enabled for transition period only
			$this->allow_php_tag = true;	//Erase this line after site fully transitioned to smarty template system
	
	        $this->caching = Smarty::CACHING_LIFETIME_CURRENT;
	        $this->assign('site__name', $site->name);
	   }
	
	}

?>