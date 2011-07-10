{*Smarty*}
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title>{$page_title}</title>
		{nocache}
		<link rel="stylesheet" href="{$css_path}" />
		{if $debug_tpl}
			<!--Debugging CSS before compilation-->
			<link rel="stylesheet" href="{$site->url}css/v2.css" />
		{/if}
		{/nocache}
		<script type="text/javascript" src="{$script_path}"></script>
		<script type="text/javascript" src="js/jquery-1.6.min.js"></script>
		<script type="text/javascript" src="js/tiny_mce/jquery.tinymce.js"></script>
		<script type="text/javascript" src="js/pingbeta.js"></script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
			{nocache}
				<h1 id="title"><a href="{$site->url}">{$site->name}</a></h1>
				<span id="description">{$site->description}</span>
				
					{$site->DisplaySearch()}
					{include file="menu.tpl"}
			{/nocache}
			</div>
			<div id="content">
				
				<div id="sidebar">
				
				</div>
				{nocache}
					{if not $debug_tpl}
						{$site->LoadContent()}
					{else}
						{$site->LoadContent()}
					{/if}
				{/nocache}			
			</div>
			<div id="footer">
				{include file="footer.tpl"}
			</div>
			
		</div>
		
	</body>
</html>