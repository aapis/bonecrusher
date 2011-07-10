<ul id="subnav">
		
		<?php if(!isset($_GET['level']) && !isset($_GET['completed'])){?>
			<li><a href="<?= $site->url; ?>" class="selected">Pending</a></li>
		<?php }else {?>
			<li><a href="<?= $site->url; ?>">Pending</a></li>
		<?php }?>
		<?php if($_GET['level'] == 1){?>
			<li><a href="<?= $site->url; ?>level/1/" class="selected">Level 1</a></li>
		<?php }else {?>
			<li><a href="<?= $site->url; ?>level/1/">Level 1</a></li>
		<?php }?>
		<?php if($_GET['level'] == 2){?>
			<li><a href="<?= $site->url; ?>level/2/" class="selected">Level 2</a></li>
		<?php }else {?>
			<li><a href="<?= $site->url; ?>level/2/">Level 2</a></li>
		<?php }?>
		<?php if($_GET['level'] == 3){?>
			<li><a href="<?= $site->url; ?>level/3/" class="selected">Level 3</a></li>
		<?php }else {?>
			<li><a href="<?= $site->url; ?>level/3/">Level 3</a></li>
		<?php }?>
		<?php if(isset($_GET['completed'])){?>
			<li><a href="<?= $site->url; ?>completed/" class="selected">All</a></li>
		<?php }else {?>
			<li><a href="<?= $site->url; ?>completed/">All</a></li>
		<?php }?>
		<li class="floatright"><a href="<?= $site->url; ?>dashboard/">Dashboard</a></li>
		<?php if(!is_null($user) && $user->logged()){ ?>
			<li class="floatright"><a href="<?= $site->url; ?>?do=logout">Logout</a></li>
			<li class="floatright"><?php $site->GroupList(); ?></li>
			<?php /*?><li class="floatright"><a href="<?= $site->url; ?>dashboard/messages.php?do=new">Messages</a></li><?php */?>
		<?php }else {?>
			<?php if(!is_null($site->storage) && $site->storage->get("registration")){?>
				<li class="floatright"><a href="<?= $site->url; ?>dashboard/index.php?do=register">Register</a></li>
			<?php }?>
		<?php }?>
				
</ul>