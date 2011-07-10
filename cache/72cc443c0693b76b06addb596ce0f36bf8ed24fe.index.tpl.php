<?php /*%%SmartyHeaderCode:19894758144dfd5a65b84b25-82367056%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '72cc443c0693b76b06addb596ce0f36bf8ed24fe' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/index.tpl',
      1 => 1308449304,
      2 => 'file',
    ),
    'f3478755d5d44e04d73fd7eec26b45659d7b1edc' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/footer.tpl',
      1 => 1304798437,
      2 => 'file',
    ),
    '20f99ac56344694278857ff1d3771f54894dd7a1' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/menu.tpl',
      1 => 1304769651,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19894758144dfd5a65b84b25-82367056',
  'has_nocache_code' => true,
  'cache_lifetime' => 3600,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Bug Tracker | Nero bugs</title>
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('css_path')->value;?>
" />
		<?php if ($_smarty_tpl->getVariable('debug_tpl')->value){?>			<!--Debugging CSS before compilation-->
			<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
css/v2.css" />
		<?php }?>		<script type="text/javascript" src="http://labs.ryanpriebe.com/bonecrusher/js/scripts.js"></script>
		<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
		<script type="text/javascript" src="js/pingbeta.js"></script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
				<h1 id="title"><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
"><?php echo $_smarty_tpl->getVariable('site')->value->name;?>
</a></h1>
				<span id="description"><?php echo $_smarty_tpl->getVariable('site')->value->description;?>
</span>
				
					<?php echo $_smarty_tpl->getVariable('site')->value->DisplaySearch();?>
					<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
					<?php if (!$_smarty_tpl->getVariable('debug_tpl')->value){?>						<?php echo $_smarty_tpl->getVariable('site')->value->LoadContent();?>
					<?php }else{ ?>						<?php echo $_smarty_tpl->getVariable('site')->value->LoadContent();?>
					<?php }?>			
			</div>
			<div id="footer">
				<p class='ftext'>&copy;2011 Bug Tracker<span class='status'><a href='http://www.ryanpriebe.com/' target='_blank'>ryanpriebe.com</a></span>			</div>
			
		</div>
		
	</body>
</html><?php } ?>