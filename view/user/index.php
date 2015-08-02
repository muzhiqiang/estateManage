<!DOCTYPE html>
<html>
<?php
	require_once('../estateManager/head.php');
	
?>
<head>
	<title>用户列表</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
    <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
	<script src="https://cdn1.lncld.net/static/js/av-mini-0.5.7.js"></script>
	<script src="https://cdn1.lncld.net/static/js/av-core-mini-0.5.7.js"></script>
	<script>
		AV.initialize("iv93628dv3xrjpsr4yjlyew0b3l53m6y28d19sorv84u9o7i", "yexl03ojeycocinymyqbvyn70c7yg6xjv5lyyrrxzl91vvl3");
		
	</script>
</head>
<body>
	<script>
	var userId=<?php echo "\"".$_GET['userId']."\"";?>;
	var query = new AV.Query('_User');
	query.get(userId, {
	  success: function(post) {
		// 成功获得实例 
		//$("#tableBody").append("<tr><td>"++"</td></tr>")
		var content = post.get("email");
		document.write(content);
		
	  },
	  error: function(object, error) {
		// 失败了.
	  }
	});
	</script>

</body>
</html>