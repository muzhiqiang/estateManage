<?php
	echo '<ul class="nav nav-pills">'.
			'<li id="index"><a href='.__PUBLIC__.'/view/estateManager/index.php'.'>首页</a></li>'.
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
   			'<li id="repair"><a href='.__PUBLIC__.'/control/repairControl.php?method=waitRepair&id='.$_SESSION['estateManager']['villageId'].'>维修管理</a></li>'.
            '<li class="navbar-right"><a href='.__PUBLIC__.'/control/estateManagerControl.php?method=logout'.'>退出</a></li>'.
            '<li class="dropdown navbar-right" id="estateManager"><a class="dropdown-toggle" data-toggle="dropdown" href="#">'.$_SESSION['estateManager']['name'].'<span class="caret"></span></a>'.
               '<ul class="dropdown-menu">'.
                  '<li id="feescale"><a href='.__PUBLIC__.'/view/estateManager/feescale.php>收费标准</a></li>'.
                  '<li id="updatePassword"><a href='.__PUBLIC__.'/view/estateManager/update.php>修改密码</a></li>'.
               '</ul>'.
            '</li>'.
	'</ul>'.
	'<hr>';
?>