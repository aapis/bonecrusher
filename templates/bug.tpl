{*Smarty*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>{$site->DisplayPageTitle()}</title>
		<link rel="stylesheet" href="{$site->url}css/{$site->ParseTheme($site->theme)}" />
		<script type="text/javascript" src="{$site->url}js/scripts.js"></script>
		<script type="text/javascript" src="{$site->url}js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="{$site->url}js/tiny_mce/jquery.tinymce.js"></script>
<script type="text/javascript">
        $(function() {
                $('textarea.comment').tinymce({
                        // Location of TinyMCE script
                        script_url : '{$site->url}js/tiny_mce/tiny_mce.js',

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
					
				<h1 id="title"><a href="{$site->url}">{$site->name}</a></h1>
				<span id="description">{$site->description}</span>
				{nocache}
					{$site->DisplaySearch()}
					{include file="menu.tpl"}
				{/nocache}
			
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
				{nocache}
					{$site->DisplayUniqueBug()}
				{/nocache}
			</div>
			<div id="footer">
				{include file="footer.tpl"}			
			</div>
			
		</div>
		
	</body>
</html>