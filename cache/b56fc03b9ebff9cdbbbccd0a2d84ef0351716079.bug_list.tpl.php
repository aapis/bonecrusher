<?php /*%%SmartyHeaderCode:12381379224dfd5b569657f2-46553710%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b56fc03b9ebff9cdbbbccd0a2d84ef0351716079' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/bug_list.tpl',
      1 => 1308436551,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '12381379224dfd5b569657f2-46553710',
  'has_nocache_code' => true,
  'cache_lifetime' => 3600,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!$no_render) {?><?php if (!is_callable('smarty_modifier_truncate')) include '/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.truncate.php';
if (!is_callable('smarty_modifier_capitalize')) include '/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.capitalize.php';
?>
<div id="bug-list">
	<?php $_smarty_tpl->tpl_vars['lastgroup'] = new Smarty_variable(null, true, null);?>	<?php $_smarty_tpl->tpl_vars['groupcounter'] = new Smarty_variable(1, true, null);?>	<?php  $_smarty_tpl->tpl_vars['anItem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('items')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['anItem']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['anItem']->iteration=0;
 $_smarty_tpl->tpl_vars['anItem']->index=-1;
if ($_smarty_tpl->tpl_vars['anItem']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['anItem']->key => $_smarty_tpl->tpl_vars['anItem']->value){
 $_smarty_tpl->tpl_vars['anItem']->iteration++;
 $_smarty_tpl->tpl_vars['anItem']->index++;
 $_smarty_tpl->tpl_vars['anItem']->first = $_smarty_tpl->tpl_vars['anItem']->index === 0;
 $_smarty_tpl->tpl_vars['anItem']->last = $_smarty_tpl->tpl_vars['anItem']->iteration === $_smarty_tpl->tpl_vars['anItem']->total;
?>		<?php if (!($_smarty_tpl->tpl_vars['anItem']->iteration % 2)){?>			<?php $_smarty_tpl->tpl_vars['class'] = new Smarty_variable("r1", true, null);?>		<?php }else{ ?>			<?php $_smarty_tpl->tpl_vars['class'] = new Smarty_variable("r2", true, null);?>		<?php }?>			<?php if ($_smarty_tpl->tpl_vars['anItem']->first||$_smarty_tpl->getVariable('lastgroup')->value!=$_smarty_tpl->tpl_vars['anItem']->value['group_name']){?>				<?php if (!$_smarty_tpl->tpl_vars['anItem']->first){?>					</ul>
				<?php }?>				<div class="project-header-row" id="headergroup_<?php echo (($tmp = @$_smarty_tpl->tpl_vars['anItem']->value['group_id'])===null||$tmp==='' ? 'empty' : $tmp);?>
">
					<?php if ($_smarty_tpl->tpl_vars['anItem']->value['group_id']==null||$_smarty_tpl->tpl_vars['anItem']->value['group_id']==0){?>						<div class='item header'><a href='<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
group/<?php echo $_smarty_tpl->tpl_vars['anItem']->value['group_id'];?>
/'>Misc.</a></div>
					<?php }else{ ?>						<div class='item header'><a href='<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
group/<?php echo $_smarty_tpl->tpl_vars['anItem']->value['group_id'];?>
/'><?php echo $_smarty_tpl->tpl_vars['anItem']->value['group_name'];?>
</a></div>
					<?php }?>				</div>
				<ul id="ulgroup_<?php echo (($tmp = @$_smarty_tpl->tpl_vars['anItem']->value['group_id'])===null||$tmp==='' ? 'empty' : $tmp);?>
">
				<?php $_smarty_tpl->tpl_vars['groupcounter'] = new Smarty_variable(1, true, null);?>			<?php }?>			<li class="project-task" bk-data-id="<?php echo $_smarty_tpl->tpl_vars['anItem']->value['bug_id'];?>
" bk-data-pinged="<?php echo $_smarty_tpl->tpl_vars['anItem']->value['bug_pinged'];?>
" bk-data-ping-by="<?php echo $_smarty_tpl->tpl_vars['anItem']->value['bug_pinged_by'];?>
" bk-data-ping-time="<?php echo $_smarty_tpl->tpl_vars['anItem']->value['bug_pinged_timestamp'];?>
">
				<div class='task-summary item <?php echo $_smarty_tpl->getVariable('class')->value;?>
'>
					<span class="internal-content">
						#<?php echo $_smarty_tpl->getVariable('groupcounter')->value;?>
.
						<a href='<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
bug/<?php echo $_smarty_tpl->tpl_vars['anItem']->value['bug_id'];?>
/?template=true'><?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars['anItem']->value['bug_summary'],70);?>
</a>
						<!--<span class="bugid">[#<?php echo $_smarty_tpl->tpl_vars['anItem']->value['bug_id'];?>
]</span>-->
					</span>
				</div>
				<div class="assignment-cell <?php echo $_smarty_tpl->getVariable('class')->value;?>
">
					<span class="internal-content">
						<?php if ($_smarty_tpl->tpl_vars['anItem']->value['user_name']){?>							Assigned to <a href="<?php echo $_smarty_tpl->getVariable('site')->value->url;?>
user/<?php echo $_smarty_tpl->tpl_vars['anItem']->value['user_id'];?>
/"><?php echo $_smarty_tpl->tpl_vars['anItem']->value['user_name'];?>
</a>
						<?php }else{ ?>							Unassigned
						<?php }?>					</span>
				</div>
				<div class='task-status-cell item <?php echo $_smarty_tpl->getVariable('class')->value;?>
 <?php echo $_smarty_tpl->getVariable('site')->value->BugStatus($_smarty_tpl->tpl_vars['anItem']->value['bug_status']);?>
'>
					<span class="internal-content">
						<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars['anItem']->value['bug_status']);?>
					</span>
				</div>
			</li>
		<?php $_smarty_tpl->tpl_vars['lastgroup'] = new Smarty_variable($_smarty_tpl->tpl_vars['anItem']->value['group_name'], true, null);?>		<?php $_smarty_tpl->tpl_vars['groupcounter'] = new Smarty_variable($_smarty_tpl->getVariable('groupcounter')->value+1, true, null);?>		<?php if ($_smarty_tpl->tpl_vars['anItem']->last){?>				</ul>
		<?php }?>	<?php }} ?></div>
<script>
	$(document).ready(function() {
	   $(".project-header-row").click(function(){
	   		var nameparts = $(this).attr("id").split("_");
	   		var groupid = nameparts[nameparts.length-1];
	   		var ulselector = "#ulgroup_"+groupid;
	   		$(ulselector).slideToggle(400);
	   });
	 });
</script>
<?php } ?>