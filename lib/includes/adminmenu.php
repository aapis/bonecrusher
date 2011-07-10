<ul id="subnav">
		
		<?php if($user->is_admin() || $user->is_mod()){ ?>
			<?php if($site->GetPageName("23") == "content.php"){?>
				<li><a href="content.php" class="selected">New</a></li>
			<?php }else {?>
				<li><a href="content.php">New</a></li>
			<?php }?>
			<?php if($site->GetPageName("23") == "mod.php"){?>
				<li><a href="mod.php" class="selected">Moderate</a></li>
			<?php }else {?>
				<li><a href="mod.php">Moderate</a></li>
			<?php }?>
		<?php }?>
		<?php if($user->is_admin()){ ?>
			<?php if($site->GetPageName("23") == "admin.php"){?>
				<li><a href="admin.php" class="selected">Administrate</a></li>
			<?php }else {?>
				<li><a href="admin.php">Administrate</a></li>
			<?php }?>
		<?php }?>
		<?php if($user->group() > 2){ ?>
			<?php if($site->GetPageName("23") == "content.php"){?>
				<li><a href="<?= $site->url; ?>dashboard/content.php?type=bug" class="selected">New Task</a></li>
			<?php }else {?>
				<li><a href="<?= $site->url; ?>dashboard/content.php?type=bug">New Task</a></li>
			<?php }?>
		<?php }?>
		<?php if($site->GetPageName("23") == "profile.php"){?>
			<li><a href="<?= $site->url; ?>dashboard/profile.php" class="selected">Profile</a></li>
		<?php }else {?>
			<li><a href="<?= $site->url; ?>dashboard/profile.php">Profile</a></li>
		<?php }?>
		<li class="floatright"><a href="<?= $site->url; ?>?do=logout">Logout</a></li>
		<?php if(!$user->is_admin() && !$user->is_mod()){ ?>
			<li><a href="../user/<?= $user->id(); ?>/">My Tasks</a></li>
		<?php }else { ?>
			<li class="floatright"><a href="../user/<?= $user->id(); ?>/">My Tasks</a></li>
		<?php }?>
		<li class="floatright"><a href="<?= $site->url; ?>dashboard/">Home</a></li>
		
</ul>
<?php if($site->GetPageName("23") == "mod.php" && ($user->is_admin() || $user->is_mod())){?>
	
	<ul id="tertiarynav">
		
		<li><a href="mod.php?type=modbugs">Tasks</a></li>
		<?php if($user->is_admin()){?>
			<li><a href="mod.php?type=modusers">Users</a></li>
			<li><a href="mod.php?type=modusergroups">User Groups</a></li>
		<?php }?>
		<li><a href="mod.php?type=modprojects">Projects</a></li>
		<li><a href="mod.php?type=modcomments">Comments</a></li>
	
	</ul>
	
<?php }elseif($site->GetPageName("23") == "admin.php" && $user->is_admin()){?>

	<ul id="tertiarynav">

		<li><a href="admin.php?type=delayed">Delayed Tasks</a></li>
		<li><a href="admin.php?type=assign">Assign Tasks</a></li>
		<li><a href="admin.php?type=usersubbugs">User Submitted</a></li>
		<li><a href="admin.php?type=status">Status</a></li>
		<li><a href="admin.php?type=report">Report</a></li>
		<li><a href="admin.php?type=completed">Completed Tasks</a></li>
		<li><a href="admin.php?type=themes">Themes</a></li>
		<li><a href="admin.php?type=settings">Settings</a></li>
	
	</ul>
	
	<?php if($_GET['type'] === "status"){?>
		
		<ul class="tertiarynav-sub">

			<li><a href="admin.php?type=status&do=review">Review</a></li>
			<li><a href="admin.php?type=status&do=incomplete">Incomplete</a></li>
			<li><a href="admin.php?type=status&do=in%20progress">In Progress</a></li>
			<?php /*?><li><a href="admin.php?type=status&do=complete">Completed</a></li><?php */?>
		
		</ul>
		
	<?php }?>
	
<?php }elseif($site->GetPageName("23") == "content.php" && ($user->is_admin() || $user->is_mod())){?>

	<ul id="tertiarynav">
	
		<li><a href="content.php?type=bug">Task</a></li>
		<li><a href="content.php?type=group">Project</a></li>
		<?php if($user->group() < 3){?>
			<li><a href="content.php?type=usergroup">User Group</a></li>
		<?php }?>
	
	</ul>

<?php }elseif($site->GetPageName("23") == "profile.php"){?>

	<ul id="tertiarynav">
		
		<li><a href="profile.php?type=editprofile">Edit Profile</a></li>
		<li><a href="profile.php?type=newmessages">Recent Messages</a></li>
		<li><a href="profile.php?type=savedmessages">Saved Messages</a></li>
		<li><a href="profile.php?type=directmessages">Direct Messages</a></li>
	
	</ul>

<?php }?>