<?php
	echo '<ul class="nav nav-pills">'.
			'<li id="index"><a href='.__PUBLIC__.'/view/estateManager/index.php'.'>首页</a></li>'.
			'<li class="dropdown" id="estateManager"><a class="dropdown-toggle" data-toggle="dropdown" href="#">账户管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="updateVillage"><a href="#">修改小区信息</a></li>'.
         			'<li id="updatePassword"><a href="#">修改密码</a></li>'.
      			'</ul>'.
   			'</li>'.
   			'<li class="dropdown" id="user"><a class="dropdown-toggle" data-toggle="dropdown" href="#">住户管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="userPass"><a href='.__PUBLIC__.'/view/manageUser/index.php'.'>本区住户</a></li>'.
         			'<li id="userApply"><a href='.__PUBLIC__.'./view/manageUser/apply.php'.'>申请名单</a></li>'.
      			'</ul>'.
   			'</li>'.
   			'<li class="dropdown" id="bill"><a class="dropdown-toggle" data-toggle="dropdown" href="#">账单管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="lookBill"><a href="#">查看账单</a></li>'.
         			'<li id="addBill"><a href="#">添加账单</a></li>'.
      			'</ul>'.
   			'</li>'.
   			'<li class="dropdown" id="notice"><a class="dropdown-toggle" data-toggle="dropdown" href="#">通知管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="lookNotice"><a href='.__PUBLIC__.'/control/noticeControl.php?method=getAll'.'>查看通知</a></li>'.
         			'<li id="addNotice"><a href='.__PUBLIC__.'/view/notice/noticeEdit.php'.'>新建通知</a></li>'.
      			'</ul>'.
   			'</li>'.
   			'<li class="dropdown" id="repair"><a class="dropdown-toggle" data-toggle="dropdown" href="#">维修管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="waitRepair"><a href="#">待维修</a></li>'.
         			'<li id="haveRepair"><a href="#">已维修</a></li>'.
      			'</ul>'.
   			'</li>'.
			'<li><a href='.__PUBLIC__.'/control/estateManagerControl.php?method=logout'.'>退出</a></li>'.
	'</ul>'.
	'<hr>';
?>