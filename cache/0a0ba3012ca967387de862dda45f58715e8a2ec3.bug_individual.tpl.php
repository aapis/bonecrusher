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
  'has_nocache_code' => true,
  'cache_lifetime' => 3600,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?><?php if (!is_callable('smarty_modifier_capitalize')) include '/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.capitalize.php';
?>
<?php if ($_smarty_tpl->getVariable('item')->value['bug_status']=="review"||$_smarty_tpl->getVariable('item')->value['bug_status']=="complete"){?>	<li class='item header'>Bug #<?php echo $_smarty_tpl->getVariable('item')->value['bug_id'];?>
		<span class='status nopad <?php echo $_smarty_tpl->getVariable('site')->value->BugStatus($_smarty_tpl->getVariable('item')->value['bug_status']);?>
'><?php echo smarty_modifier_capitalize($_smarty_tpl->getVariable('item')->value['bug_status']);?>
</span>
	</li>
<?php }else{ ?>	<?php if (($_smarty_tpl->getVariable('item')->value['bug_assignee']==$_smarty_tpl->getVariable('user')->value->id())){?>		<li class='item header'>Bug #<?php echo $_smarty_tpl->getVariable('item')->value['bug_id'];?>
			<span class='status nopad <?php echo $_smarty_tpl->getVariable('site')->value->BugStatus($_smarty_tpl->getVariable('item')->value['bug_status']);?>
'><a href='<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
bug.php?b=<?php echo $_smarty_tpl->getVariable('item')->value['bug_id'];?>
'>Review</a></span>
			<span class='status nopad <?php echo $_smarty_tpl->getVariable('site')->value->BugStatus($_smarty_tpl->getVariable('item')->value['bug_status']);?>
'><?php echo $_smarty_tpl->getVariable('item')->value['bug_status'];?>
</span></li>
	<?php }else{ ?>		<li class='item header'>Bug #<?php echo $_smarty_tpl->getVariable('item')->value['bug_id'];?>
			<span class='status nopad <?php echo $_smarty_tpl->getVariable('site')->value->BugStatus($_smarty_tpl->getVariable('item')->value['bug_status']);?>
'><?php echo $_smarty_tpl->getVariable('item')->value['bug_status'];?>
</span>
		</li>				
	<?php }?><?php }?>				
<li class='item'>Level: <?php echo $_smarty_tpl->getVariable('item')->value['bug_level'];?>
</li>
<li class='item'><?php echo $_smarty_tpl->getVariable('site')->value->GetName($_smarty_tpl->getVariable('item')->value['bug_assignee']);?>
</li>
				
<?php if (!is_null($_smarty_tpl->getVariable('item')->value['bug_submitter'])){?>	
	<li class='item'>Submitted by <?php echo $_smarty_tpl->getVariable('site')->value->GetName($_smarty_tpl->getVariable('item')->value['bug_submitter']);?>
</li>
<?php }?>
<li class='item'>Group: <?php echo $_smarty_tpl->getVariable('site')->value->GroupName($_smarty_tpl->getVariable('item')->value['bug_group']);?>
</li>

<?php if ($_smarty_tpl->getVariable('item')->value['bug_phours']!=0){?>	<li class='item'>Projected Hours: <?php echo $_smarty_tpl->getVariable('item')->value['bug_phours'];?>
</li>
<?php }?>
<?php if (!is_null($_smarty_tpl->getVariable('item')->value['bug_ahours'])){?>	<li class='item'>Actual Hours: <?php echo $_smarty_tpl->getVariable('item')->value['bug_ahours'];?>
<span class='status'><a href='#'>Add Hours</a></span></li>
<?php }?><li class='item'><strong><?php echo $_smarty_tpl->getVariable('item')->value['bug_summary'];?>
</strong></li>
<?php } ?>