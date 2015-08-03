<?php
require_once('../estateManager/head.php');
require_once('../../utils/getInformation.php');
if(isset($_POST['searchBui'])||isset($_POST['searchFlo'])||isset($_POST['searchUni']))
{
	if(!empty($_POST['searchBui'])) $building=$_POST['searchBui'];
	else $building="unset";
	if(!empty($_POST['searchFlo'])) $floor=$_POST['searchFlo'];
	else $floor="unset";
	if(!empty($_POST['searchUni'])) $unit=$_POST['searchUni'];
	else $unit="unset";
	HttpClient::init($HttpClient, array('userAgent' => $_SERVER['HTTP_USER_AGENT'], 'redirect' => true));
	$HttpClient->get("http://localhost/estateManagement/control/billControl.php?method=search&building=".$building."&floor=".$floor."&unit=".$unit);
	$json=json_decode($HttpClient->buffer,true);
}
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
	<?php require_once('../estateManager/navigation.php');
	?>
	<script type="text/javascript">
		document.getElementById('bill').setAttribute('class','active');
	</script>
	<div class="col-sm-3"></div>
	<div align="center" class="col-sm-6">
	<form role="form" method="POST" action=<?php echo __PUBLIC__.'/view/bill/search.php';?>>
		<div class="input-group">
         <input type="text" class="form-control" name="searchBui">
         <span class="input-group-addon">栋</span>
         <input type="text" class="form-control" name="searchFlo">
         <span class="input-group-addon">层</span>
         <input type="text" class="form-control" name="searchUni">
         <span class="input-group-addon" >单元</span>
            <span class="input-group-btn">
          	    <button class="btn btn-default" type="submit" name="findUser">
                    搜索
                </button>
            </span>
          </div>
	</form>
	</div>
	<div class="container">
	<table class="table table-hover table-bordered table-responsive">
		<thead>
			<tr>
				<th>座别</th>
				<th>楼层</th>
				<th>单元</th>
				<th>查看账单</th>
			</tr>
		</thead>
		<tbody>
			<?php
			if(!empty($json))
			{
				foreach ($json as $key => $value) {
					if(!empty($value['user']))
					{
						echo "<tr>";
						if(empty($value['building']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['building']."</td>";
						if(empty($value['floor']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['floor']."</td>";
						if(empty($value['unit']))
							echo "<td>未知</td>";
						else
							echo "<td>".$value['unit']."</td>";

						
						echo "<td><a href=\"../../control/billControl.php?method=showUserBill&houseId=".$value['objectId']."\">查看账单</a></td>";
						echo "</tr>";
					}
			}
			}
			
		?>
		</tbody>
	</table>
	</div>
</body>
</html>