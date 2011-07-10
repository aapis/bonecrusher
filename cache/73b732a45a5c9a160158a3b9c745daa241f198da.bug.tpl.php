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
  'nocache_hash' => '12846725354dfd5a9de32151-21029099',
  'has_nocache_code' => true,
  'cache_lifetime' => 3600,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>Bug Tracker | Bug #20</title>
		<link rel="stylesheet" href="http://labs.ryanpriebe.com/bonecrusher/css/apple.css" />
		<script type="text/javascript" src="http://labs.ryanpriebe.com/bonecrusher/js/scripts.js"></script>
		<script type="text/javascript" src="http://labs.ryanpriebe.com/bonecrusher/js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="http://labs.ryanpriebe.com/bonecrusher/js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
        $(function() {
                $('textarea.comment').tinymce({
                        // Location of TinyMCE script
                        script_url : 'http://labs.ryanpriebe.com/bonecrusher/js/tiny_mce/tiny_mce.js',

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
					
				<h1 id="title"><a href="http://labs.ryanpriebe.com/bonecrusher/">Bug Tracker</a></h1>
				<span id="description">in ur internets, trackin ur fookups</span>
					<?php echo $_smarty_tpl->getVariable('site')->value->DisplaySearch();?>
					<?php $_template = new Smarty_Internal_Template("menu.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>			
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
					<?php echo $_smarty_tpl->getVariable('site')->value->DisplayUniqueBug();?>
			</div>
			<div id="footer">
				<p class='ftext'>&copy;2011 Bug Tracker<span class='status'><a href='http://www.ryanpriebe.com/' target='_blank'>ryanpriebe.com</a></span>			
			</div>
			
		</div>
		
	</body>
</html><?php } ?>