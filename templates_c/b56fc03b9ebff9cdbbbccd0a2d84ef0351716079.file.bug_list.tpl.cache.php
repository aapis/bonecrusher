<?php /* Smarty version Smarty-3.0.7, created on 2011-06-18 19:13:42
         compiled from "/home/vistyle/labs/bonecrusher/templates/bug_list.tpl" */ ?>
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
  'function' => 
  array (
  ),
  'has_nocache_code' => true,
)); /*/%%SmartyHeaderCode%%*/?>
<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if (!is_callable(\'smarty_modifier_truncate\')) include \'/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.truncate.php\';
if (!is_callable(\'smarty_modifier_capitalize\')) include \'/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.capitalize.php\';
?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>

<div id="bug-list">
	<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'lastgroup\'] = new Smarty_variable(null, true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
	<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'groupcounter\'] = new Smarty_variable(1, true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
	<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php  $_smarty_tpl->tpl_vars[\'anItem\'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable(\'items\')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, \'array\');}
 $_smarty_tpl->tpl_vars[\'anItem\']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars[\'anItem\']->iteration=0;
 $_smarty_tpl->tpl_vars[\'anItem\']->index=-1;
if ($_smarty_tpl->tpl_vars[\'anItem\']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars[\'anItem\']->key => $_smarty_tpl->tpl_vars[\'anItem\']->value){
 $_smarty_tpl->tpl_vars[\'anItem\']->iteration++;
 $_smarty_tpl->tpl_vars[\'anItem\']->index++;
 $_smarty_tpl->tpl_vars[\'anItem\']->first = $_smarty_tpl->tpl_vars[\'anItem\']->index === 0;
 $_smarty_tpl->tpl_vars[\'anItem\']->last = $_smarty_tpl->tpl_vars[\'anItem\']->iteration === $_smarty_tpl->tpl_vars[\'anItem\']->total;
?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if (!($_smarty_tpl->tpl_vars[\'anItem\']->iteration % 2)){?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
			<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'class\'] = new Smarty_variable("r1", true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }else{ ?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
			<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'class\'] = new Smarty_variable("r2", true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
			<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if ($_smarty_tpl->tpl_vars[\'anItem\']->first||$_smarty_tpl->getVariable(\'lastgroup\')->value!=$_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_name\']){?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
				<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if (!$_smarty_tpl->tpl_vars[\'anItem\']->first){?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
					</ul>
				<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
				<div class="project-header-row" id="headergroup_<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo (($tmp = @$_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_id\'])===null||$tmp===\'\' ? \'empty\' : $tmp);?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>">
					<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if ($_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_id\']==null||$_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_id\']==0){?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
						<div class='item header'><a href='<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>group/<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_id\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>/'>Misc.</a></div>
					<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }else{ ?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
						<div class='item header'><a href='<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>group/<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_id\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>/'><?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_name\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?></a></div>
					<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
				</div>
				<ul id="ulgroup_<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo (($tmp = @$_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_id\'])===null||$tmp===\'\' ? \'empty\' : $tmp);?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>">
				<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'groupcounter\'] = new Smarty_variable(1, true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
			<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
			<li class="project-task" bk-data-id="<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_id\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>" bk-data-pinged="<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_pinged\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>" bk-data-ping-by="<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_pinged_by\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>" bk-data-ping-time="<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_pinged_timestamp\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>">
				<div class='task-summary item <?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'class\')->value;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>'>
					<span class="internal-content">
						#<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'groupcounter\')->value;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>.
						<a href='<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>bug/<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_id\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>/?template=true'><?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo smarty_modifier_truncate($_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_summary\'],70);?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?></a>
						<!--<span class="bugid">[#<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_id\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>]</span>-->
					</span>
				</div>
				<div class="assignment-cell <?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'class\')->value;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>">
					<span class="internal-content">
						<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if ($_smarty_tpl->tpl_vars[\'anItem\']->value[\'user_name\']){?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
							Assigned to <a href="<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->url;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>user/<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'user_id\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>/"><?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->tpl_vars[\'anItem\']->value[\'user_name\'];?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?></a>
						<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }else{ ?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
							Unassigned
						<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
					</span>
				</div>
				<div class='task-status-cell item <?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'class\')->value;?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?> <?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo $_smarty_tpl->getVariable(\'site\')->value->BugStatus($_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_status\']);?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>'>
					<span class="internal-content">
						<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php echo smarty_modifier_capitalize($_smarty_tpl->tpl_vars[\'anItem\']->value[\'bug_status\']);?>
/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
					</span>
				</div>
			</li>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'lastgroup\'] = new Smarty_variable($_smarty_tpl->tpl_vars[\'anItem\']->value[\'group_name\'], true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php $_smarty_tpl->tpl_vars[\'groupcounter\'] = new Smarty_variable($_smarty_tpl->getVariable(\'groupcounter\')->value+1, true, null);?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php if ($_smarty_tpl->tpl_vars[\'anItem\']->last){?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
				</ul>
		<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
	<?php echo '/*%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/<?php }} ?>/*/%%SmartyNocache:12381379224dfd5b569657f2-46553710%%*/';?>
</div>
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
