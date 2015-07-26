<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>编辑通知</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<table>
<?php require_once('../estateManager/navigation.php');?>
<script type="text/javascript">
	document.getElementById('notice').setAttribute('class','dropdown active');
	document.getElementById('addNotice').setAttribute('class','active');
</script>
<div align="center">
	<form class="form-horizontal" role="form" method="post" action=<?php echo __PUBLIC__.'/control/noticeControl.php?method=add'?>>
		<div class="row form-group">
			<label for="title" class="col-sm-4 control-label">标题</label>
			<div class="col-sm-4">
				<input type="text" class="form-control" name="title"></br>
			</div>
		</div>
		<div class="row form-group">
			<label for="content" class="col-sm-4 control-label">内容</label>
			<div class="col-sm-4">
				<textarea class="form-control" name="content"></textarea>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-6">
				<button type="submit" class="btn btn-primary">发布</button>
			</div>
		</div>
	</form>
</div>
</table>
</body>
</html>