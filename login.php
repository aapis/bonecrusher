<?php require_once('lib/config.php'); ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
	<head>
		<title><?= $site->name; ?></title>
		<link rel="stylesheet" href="css/<?= $site->ParseTheme($site->theme); ?>" />
	</head>
	<body>
		
		<form method="post" action="">
		
			<input type="text" name="username" /><br />
			<input type="text" name="password" /><br />
			<br />
			<input type="submit" value="Login" />
			<input type="hidden" name="aliens" value="attacking" />
		
		</form>
		
	</body>
</html>