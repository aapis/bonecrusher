<?php /* Smarty version Smarty-3.0.7, created on 2011-06-18 19:09:11
         compiled from "/home/vistyle/labs/bonecrusher/templates/menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3958605504dfd5a47033270-78753494%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '20f99ac56344694278857ff1d3771f54894dd7a1' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/menu.tpl',
      1 => 1304769651,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3958605504dfd5a47033270-78753494',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>

<ul id="subnav">
		<?php if (is_null($_smarty_tpl->getVariable('get')->value['level'])&&!isset($_smarty_tpl->getVariable('get',null,true,false)->value['completed'])){?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
" class="selected">Pending</a></li>
		<?php }else{ ?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
">Pending</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('get')->value['level']==1){?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
level/1/" class="selected">Level 1</a></li>
		<?php }else{ ?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
level/1/">Level 1</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('get')->value['level']==2){?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
level/2/" class="selected">Level 2</a></li>
		<?php }else{ ?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
level/2/">Level 2</a></li>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('get')->value['level']==3){?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
level/3/" class="selected">Level 3</a></li>
		<?php }else{ ?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
level/3/">Level 3</a></li>
		<?php }?>
		<?php if (isset($_smarty_tpl->getVariable('get',null,true,false)->value['completed'])){?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
completed/" class="selected">All</a></li>
		<?php }else{ ?>
			<li><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
completed/">All</a></li>
		<?php }?>
		<li class="floatright"><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
dashboard/">Dashboard</a></li>
		<?php if (!is_null($_smarty_tpl->getVariable('user')->value)&&$_smarty_tpl->getVariable('user')->value->logged()){?>
			<li class="floatright"><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
?do=logout">Logout</a></li>
			<li class="floatright"><?php echo $_smarty_tpl->getVariable('site')->value->GroupList();?>
</li>
		<?php }else{ ?>
			<?php if (!is_null($_smarty_tpl->getVariable('site')->value->storage)&&$_smarty_tpl->getVariable('site')->value->storage->get("registration")){?>
				<li class="floatright"><a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
dashboard/index.php?do=register">Register</a></li>
			<?php }?>
		<?php }?>
</ul>