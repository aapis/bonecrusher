<?php /* Smarty version Smarty-3.0.7, created on 2011-06-18 19:13:47
         compiled from "/home/vistyle/labs/bonecrusher/templates/bug_individual.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1168352894dfd5b5bbe0b86-76302696%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '0a0ba3012ca967387de862dda45f58715e8a2ec3' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/bug_individual.tpl',
      1 => 1305142327,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1168352894dfd5b5bbe0b86-76302696',
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php if (!is_callable(\'smarty_modifier_capitalize\')) include \'/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.capitalize.php\';
?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>

<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php if ($_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']=="review"||$_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']=="complete"){?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
	<li class='item header'>Bug #<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_id\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
		<span class='status nopad <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->BugStatus($_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>'><?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></span>
	</li>
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }else{ ?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
	<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php if (($_smarty_tpl->getVariable(\'item\')->value[\'bug_assignee\']==$_smarty_tpl->getVariable(\'user\')->value->id())){?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
		<li class='item header'>Bug #<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_id\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
			<span class='status nopad <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->BugStatus($_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>'><a href='<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>bug.php?b=<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_id\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>'>Review</a></span>
			<span class='status nopad <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->BugStatus($_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>'><?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_status\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></span></li>
	<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }else{ ?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
		<li class='item header'>Bug #<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_id\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
			<span class='status nopad <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->BugStatus($_smarty_tpl->getVariable(\'item\')->value[\'bug_status\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>'><?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_status\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></span>
		</li>				
	<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
				
<li class='item'>Level: <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_level\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></li>
<li class='item'><?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->GetName($_smarty_tpl->getVariable(\'item\')->value[\'bug_assignee\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></li>
				
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php if (!is_null($_smarty_tpl->getVariable(\'item\')->value[\'bug_submitter\'])){?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>	
	<li class='item'>Submitted by <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->GetName($_smarty_tpl->getVariable(\'item\')->value[\'bug_submitter\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></li>
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>

<li class='item'>Group: <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->GroupName($_smarty_tpl->getVariable(\'item\')->value[\'bug_group\']);?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></li>

<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php if ($_smarty_tpl->getVariable(\'item\')->value[\'bug_phours\']!=0){?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
	<li class='item'>Projected Hours: <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_phours\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></li>
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>

<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php if (!is_null($_smarty_tpl->getVariable(\'item\')->value[\'bug_ahours\'])){?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
	<li class='item'>Actual Hours: <?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_ahours\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?><span class='status'><a href='#'>Add Hours</a></span></li>
<?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php }?>/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?>
<li class='item'><strong><?php echo '/*%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/<?php echo $_smarty_tpl->getVariable(\'item\')->value[\'bug_summary\'];?>
/*/%%SmartyNocache:1168352894dfd5b5bbe0b86-76302696%%*/';?></strong></li>
