<?php
require_once('../estateManager/head.php');
$key = $_GET['key'];
$type = $_GET['type'];
?>
<!DOCTYPE html>
<html>
<head>
	<title>维修信息</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php 
require_once('../estateManager/navigation.php');
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('repair').setAttribute('class','active');
</script>
<div class="col-sm-5">
	<dl>
		<dd><h3>内容</h3></dd><hr>
		<dt><?php echo $_SESSION[$type][$key]['content'];?></dt><hr>
		<?php if(!empty($_SESSION[$type][$key]['urls'])){
			echo "<dd><h3>图片</h3></dd><hr><dt>";
				foreach ($_SESSION[$type][$key]['urls'] as $value) {
					echo '<img src=http://'.$value.' class="img-rounded" width=250 hight=250>';
				}
			
			echo "</dt>";
		}		
		?>
	</dl>
</div>
</body>
</html>