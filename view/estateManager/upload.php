<?php
require_once('head.php');
?>
<html>
<head>
	<title>上传资料</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
<?php
require_once('navigation.php');
?>
<script type="text/javascript">
	document.getElementById('estateManager').setAttribute('class','navbar-right dropdown active');
	document.getElementById('upload').setAttribute('class','active');
</script>
<div class="container" align="center">
<form action=<?php echo __PUBLIC__."/control/uploadFileControl.php";?> method="post" enctype="multipart/form-data" role="form">
<div class="row form-group">
	<label for="file" class="control-label">文件</label>
	<div class="input-group">
		<input type="file" name="file" id="file" class="form-control" /> 
	</div>
</div>
<div class="form-group">
	<div class="col-sm-offset-6 col-sm-6">
		<button type="submit" class="btn btn-primary">确定</button>
	</div>
</div>
</form>
</div>
</body>
</html>