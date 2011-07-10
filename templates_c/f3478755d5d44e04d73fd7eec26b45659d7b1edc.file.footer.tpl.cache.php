<?php /* Smarty version Smarty-3.0.7, created on 2011-06-18 19:09:41
         compiled from "/home/vistyle/labs/bonecrusher/templates/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:510769724dfd5a65c87379-02642693%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f3478755d5d44e04d73fd7eec26b45659d7b1edc' => 
    array (
      0 => '/home/vistyle/labs/bonecrusher/templates/footer.tpl',
      1 => 1304798437,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '510769724dfd5a65c87379-02642693',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_date_format')) include '/home/vistyle/labs/bonecrusher/lib/smarty/plugins/modifier.date_format.php';
?>
<p class='ftext'>&copy;<?php echo smarty_modifier_date_format(time(),"%Y");?>
 <?php echo $_smarty_tpl->getVariable('site')->value->name;?>
<span class='status'><a href='http://www.ryanpriebe.com/' target='_blank'>ryanpriebe.com</a></span>