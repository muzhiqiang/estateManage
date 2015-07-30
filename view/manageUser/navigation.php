<?php
	echo '<div class="col-sm-3">'.
			'<ul class="nav nav-pills nav-stacked">'.
				'<li id="detail"><a href='.__PUBLIC__.'/view/manageUser/detail.php?objectId='.$_GET['objectId'].'>查看信息</a></li>'.
				'<li id="update"><a href='.__PUBLIC__.'/control/manageUserControl.php?getMethod=modify&objectId='.$json['userInfo']['objectId'].'>修改信息</a></li>'.
				'<li id="newBill"><a href='.__PUBLIC__.'/view/manageUser/newBill.php?objectId='.$_GET['objectId'].'>当月账单</a></li>'.
			'</ul>'.
		 '</div>';
?>
