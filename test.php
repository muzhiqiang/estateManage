<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title></title>
</head>
<body>
	<?php
if(isset($_COOKIE['test']))
			echo $_COOKIE['test'];
		else
			setcookie('test','heheda',time()+60*60);
?>
</body>
</html>

