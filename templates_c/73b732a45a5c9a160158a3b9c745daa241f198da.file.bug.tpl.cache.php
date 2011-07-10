<?php /* Smarty version Smarty-3.0.7, created on 2011-06-18 19:10:37
         compiled from "/home/vistyle/labs/bonecrusher/templates/bug.tpl" */ ?>
<?php /*%%SmartyHeaderCode:12846725354dfd5a9de32151-21029099%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '73b732a45a5c9a160158a3b9c745daa241f198da' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/bug.tpl',
      1 => 1304973913,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12846725354dfd5a9de32151-21029099',
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
)); /*/%%SmartyHeaderCode%%*/?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?php echo $_smarty_tpl->getVariable('site')->value->DisplayPageTitle();?>
</title>
		<link rel="stylesheet" href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
css/<?php echo $_smarty_tpl->getVariable('site')->value->ParseTheme($_smarty_tpl->getVariable('site')->value->theme);?>
" />
		<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
js/scripts.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
        $(function() {
                $('textarea.comment').tinymce({
                        // Location of TinyMCE script
                        script_url : '<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
js/tiny_mce/tiny_mce.js',

				        theme : "advanced",
				        mode : "none",
				        plugins : "bbcode,emotions",
				        theme_advanced_buttons1 : "emotions,bold,italic,underline,undo,redo,link,unlink,image,forecolor,backcolor,removeformat,cleanup",
				        theme_advanced_buttons2 : "",
				        theme_advanced_buttons3 : "",
				        theme_advanced_toolbar_location : "bottom",
				        theme_advanced_toolbar_align : "center",
				        theme_advanced_styles : "Code=codeStyle;Quote=quoteStyle",
				        content_css : "css/bbcode.css",
				        entity_encoding : "raw",
				        add_unload_trigger : false,
				        remove_linebreaks : false,
				        inline_styles : false,
				        convert_fonts_to_spans : false,

                        // Replace values for the template plugin
                        template_replace_values : {
                                username : "Some User",
                                staffid : "991234"
                        }
                });
        });
</script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
					
				<h1 id="title"><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
"><?php echo $_smarty_tpl->getVariable('site')->value->name;?>
</a></h1>
				<span id="description"><?php echo $_smarty_tpl->getVariable('site')->value->description;?>
</span>
					<?php echo '/*%%SmartyNocache:12846725354dfd5a9de32151-21029099%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->DisplaySearch();?>
/*/%%SmartyNocache:12846725354dfd5a9de32151-21029099%%*/';?>
					<?php echo '/*%%SmartyNocache:12846725354dfd5a9de32151-21029099%%*/<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>/*/%%SmartyNocache:12846725354dfd5a9de32151-21029099%%*/';?>
			
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
					<?php echo '/*%%SmartyNocache:12846725354dfd5a9de32151-21029099%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->DisplayUniqueBug();?>
/*/%%SmartyNocache:12846725354dfd5a9de32151-21029099%%*/';?>
			</div>
			<div id="footer">
				<?php $_template = new Smarty_Internal_Template("footer.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 9999, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>			
			</div>
			
		</div>
		
	</body>
</html>