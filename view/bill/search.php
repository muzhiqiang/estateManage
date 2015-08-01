<?php
require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>账单查询</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
</head>
<body>
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('bill').setAttribute('class','active');
	</script>
	<div class="col-sm-3"></div>
	<div align="center" class="col-sm-6">
	<form role="form" method="POST" action=<?php echo __PUBLIC__.'/control/billControl.php?id='.$_SESSION['estateManager'][''];?>>
		<div class="input-group">
         <input type="text" class="form-control">
         <span class="input-group-addon">栋</span>
         <input type="text" class="form-control">
         <span class="input-group-addon">层</span>
         <input type="text" class="form-control">
         <span class="input-group-addon">单元</span>
            <span class="input-group-btn">
          	    <button class="btn btn-default" type="submit" name="findUser">
                    搜索
                </button>
            </span>
          </div>
	</form>
	</div>
</body>
</html>