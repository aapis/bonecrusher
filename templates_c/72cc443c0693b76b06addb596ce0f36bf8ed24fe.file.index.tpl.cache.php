<?php /* Smarty version Smarty-3.0.7, created on 2011-06-18 19:09:41
         compiled from "/home/vistyle/labs/bonecrusher/templates/index.tpl" */ ?>
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
  ),
  'nocache_hash' => '19894758144dfd5a65b84b25-82367056',
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
)); /*/%%SmartyHeaderCode%%*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $_smarty_tpl->getVariable('page_title')->value;?>
</title>
		<link rel="stylesheet" href="<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'css_path\')->value;?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>" />
		<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php if ($_smarty_tpl->getVariable(\'debug_tpl\')->value){?>/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
			<!--Debugging CSS before compilation-->
			<link rel="stylesheet" href="<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>css/v2.css" />
		<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php }?>/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('script_path')->value;?>
"></script>
		<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
		<script type="text/javascript" src="js/pingbeta.js"></script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
				<h1 id="title"><a href="<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>"><?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->name;?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?></a></h1>
				<span id="description"><?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->description;?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?></span>
				
					<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->DisplaySearch();?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
					<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
					<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php if (!$_smarty_tpl->getVariable(\'debug_tpl\')->value){?>/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
						<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->LoadContent();?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
					<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php }else{ ?>/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
						<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->LoadContent();?>
/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>
					<?php echo '/*%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/<?php }?>/*/%%SmartyNocache:19894758144dfd5a65b84b25-82367056%%*/';?>			
			</div>
			<div id="footer">
				<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
			</div>
			
		</div>
		
	</body>
</html>