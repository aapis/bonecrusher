<?php 

	require_once('../lib/config.php'); 

	if(!$user->name() || !$user->group() > 1){
	
		header("Location:index.php");
	
	}
	
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?= $site->name; ?></title>
		<link rel="stylesheet" href="<?= $site->url; ?>css/<?= $site->ParseTheme($site->theme); ?>" />
		<script type="text/javascript" src="<?= $site->url; ?>js/scripts.js"></script>
	</head>
	<body>
		
		<div id="wrapper">

			<div id="header">
					
				<h1 id="title"><a href="<?= $site->url; ?>"><?= $site->name; ?></a></h1>
				<span id="description"><?= $site->description; ?></span>
				
				<?php include("../lib/includes/adminmenu.php"); ?>
			
			</div>
			<div id="content">
				
				<?php if(!empty($_GET)){?>
					<div class="adminborder">
					<div class="adminwrap">
				<?php }?>
<?php

	if($_GET['type'] == "bug"){
		
		global $user;
		
		$usergroups = $db->q("SELECT * FROM trkr_usergroup");
		$groups = $db->query_as_array("SELECT * FROM trkr_groups ORDER BY group_name ASC");
		
		if(isset($_POST['gremlins'])){
		
			if(!isset($_GET['id'])){
		
				if($user->group() <= 2){
				
					if($_POST['assigned_to'] != 0){$status = "in progress";}else {$status = "incomplete";}
				
					$db->insert("INSERT INTO trkr_bugs(bug_level, bug_assignee, bug_status, bug_summary, bug_group, bug_phours, bug_submitter) VALUES(
						'". Securitizor::Stripper($_POST['level']) ."',
						'". Securitizor::Stripper($_POST['assigned_to']) ."',
						'". $status ."',
						'". Securitizor::Stripper($_POST['summary']) ."',
						'". Securitizor::Stripper($_POST['group']) ."',
						'". Securitizor::Stripper($_POST['projhours']) ."',
						'". $user->id() ."'
					)");
					
				}else {
				
					$db->insert("INSERT INTO trkr_bugs(bug_level, bug_assignee, bug_status, bug_summary, bug_group, bug_phours, bug_submitter, bug_con) VALUES(
						'". Securitizor::Stripper($_POST['level']) ."',
						'". Securitizor::Stripper($_POST['assigned_to']) ."',
						'". $status ."',
						'". Securitizor::Stripper($_POST['summary']) ."',
						'". Securitizor::Stripper($_POST['group']) ."',
						'". Securitizor::Stripper($_POST['projhours']) ."',
						'". $user->id() ."',
						'0'
					)");
				
				}
			
			}else {
			
				$db->update("UPDATE trkr_bugs SET 
					bug_level = '". Securitizor::Stripper($_POST['level']) ."',
					bug_assignee = '". Securitizor::Stripper($_POST['assigned_to']) ."',
					bug_status = '". Securitizor::Stripper($_POST['status']) ."',
					bug_summary = '". Securitizor::Stripper($_POST['summary']) ."',
					bug_group = '". Securitizor::Stripper($_POST['group']) ."',
					bug_phours = '". Securitizor::Stripper($_POST['projhours']) ."'
					WHERE bug_id = '". Securitizor::Stripper($_GET['id']) ."'
				");
			
			}
					
		}

?>
	<form method="post" action="" id="newbug">
		
		<?php if(isset($_GET['id'])){
		
			$bug = $db->query_as_array("SELECT * FROM trkr_bugs WHERE bug_id = ". Securitizor::Stripper($_GET['id']));
		
		}?>
		<label for="level_control">Level</label>
		<select name="level" id="level_control">
				<option>Select...</option>
				<option>1</option>
				<option>2</option>
				<option>3</option>
		</select>
		<br/>
		<?php if($user->is_admin() || $user->is_mod()){?>
		<label for="assigned_to">Assign to:</label>
			<select name="assigned_to" id="assigned_to">
				<option>Select...</option>
				<?php 
					foreach($usergroups as $g){
					
						$users = $db->query_as_array("SELECT user_name, user_id FROM trkr_users WHERE user_group = ". $g['ugroup_id']);
							if(count($users[0]) > 1){ ?>
							
							<option disabled="disabled"><?= ucwords($g['ugroup_name']); ?></option>
							
							<?php foreach($users as $u){ ?>
								<option value="<?= $u['user_id']; ?>"><?= $u['user_name']; ?></option>
							<?php }?>
						<?php }?>
				<?php }?>
			</select>
			<br />
		<?php }?>
		<?php if(isset($_GET['id'])){?>
		<label for="status">Status: </label><select name="status" id="status">
			<option>incomplete</option>
			<option>complete</option>
			<option>in progress</option>
			<option>review</option>
		</select>
			<br />
		<?php }?>
		<label for="group">Project: </label><select name="group" id="group">
			<option>Select...</option>
			<?php foreach($groups as $group){?>
				<option value="<?= $group['group_id']; ?>" <?php if(in_array($bug[0]['bug_group'], $group)){echo "selected='selected'";}?>><?= ucwords($group['group_name']); ?></option>
			<?php }?>
		</select>
		<?php if($user->is_admin() || $user->is_mod()){?>
			<br />
		<label for="projhours">Projected Hours: </label><input type="text" name="projhours" id="projhours" value="<?= $bug[0]['bug_phours']; ?>" />
		<?php }?>
			<br />
		<label for="summary">Summary:</label>
			<textarea name="summary" id="summary"><?= $bug[0]['bug_summary']; ?></textarea>
			<br />
		<?php if(!isset($_GET['id'])){?>
			<input type="submit" value="New Task" class="btn floatright" />
		<?php }else {?>
			<input type="submit" value="Edit Task" class="btn floatright" />
		<?php }?>
		<div class="clear"></div>
		<input type="hidden" name="gremlins" />
		
	</form>
	
<?php }else if($_GET['type'] == "group"){ ?>

	<?php 
		
		if(isset($_POST['gremlins'])){
			
			if(!isset($_GET['id'])){
			
				$db->insert("INSERT INTO trkr_groups(group_name) VALUES('". Securitizor::Stripper($_POST['group_name']) ."')");
			
			}else {
			
				$db->insert("UPDATE trkr_groups SET 
					group_name = '". Securitizor::Stripper($_POST['group_name']) ."'
					WHERE group_id = ". Securitizor::Stripper($_GET['id']) ."
				");
			
			}
			
		}
	
	?>

	<form method="post" action="" id="newgroup">
		
		<label for="group_name">Project Name: </label><input type="text" name="group_name" id="group_name" size="40" value="<?php if(isset($_GET['id'])){ echo $site->GroupName($_GET['id']);} ?>" /><br />
		<?php if(isset($_GET['id'])){?>
			<input type="submit" value="Edit Group" id="post"/>
		<?php }else {?>
			<input type="submit" value="New Group" id="post"/>
		<?php }?>
		<input type="hidden" name="gremlins" />
	
	</form>

<?php }elseif($_GET['type'] == "usergroup"){?>

	<?php 
	
		if(isset($_POST['blur'])){
		
			if(!isset($_GET['id'])){
			
				$db->insert("INSERT INTO trkr_usergroup(ugroup_name) VALUES('". Securitizor::Stripper($_POST['ugroup_name']) ."')");
			
			}else {
			
				$db->insert("UPDATE trkr_usergroup SET 
					ugroup_name = '". Securitizor::Stripper($_POST['ugroup_name']) ."'
					WHERE ugroup_id = ". Securitizor::Stripper($_GET['id']) ."
				");
			
			}
		
		}
		
	?>

	<form method="post" action="" id="newusergroup">
		
		<?php if($_GET['id'] != 1){ ?>
			
			<label for="ugroup_name">Group Name: </label><input type="text" name="ugroup_name" id="ugroup_name" size="40" value="<?php if(isset($_GET['id'])){ echo $site->UserGroupName($_GET['id']);} ?>" /><br />
			
			<?php if(!isset($_GET['id'])){?>
				<input type="submit" value="New User Group" id="post"/>
			<?php }else {?>
				<input type="submit" value="Edit" id="post" />
			<?php }?>
			
			<input type="hidden" name="blur" />
			
		<?php }else { ?>
			
			<p>You cannot edit the admin group. <a href="mod.php?type=modusergroups">Back</a></p>
			
		<?php }?>
		
	</form>

<?php }else { ?>
	<?= $site->GenericContent(); ?>
<?php }?>	
			<?php if(!empty($_GET)){?>
				</div>
			<?php }?>
			</div>
			<div id="footer">
			
				<?= $site->DisplayFooter(); ?>
			
			</div>
			
			</div>
			
			
		</div>
		
	</body>
</html>