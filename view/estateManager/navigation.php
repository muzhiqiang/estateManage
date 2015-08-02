<?php
	echo '<ul class="nav nav-pills">'.
			'<li id="index"><a href='.__PUBLIC__.'/view/estateManager/index.php'.'>首页</a></li>'.
   			'<li class="dropdown" id="user"><a class="dropdown-toggle" data-toggle="dropdown" href="#">住户管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="userPass"><a href='.__PUBLIC__.'/view/user/index.php'.'>本区住户</a></li>'.
         			'<li id="userApply"><a href='.__PUBLIC__.'./view/manageUser/apply.php'.'>申请名单</a></li>'.
      			'</ul>'.
   			'</li>'.
   			'<li id="bill"><a href='.__PUBLIC__.'/view/bill/search.php>账单管理</a></li>'.   			
   			'<li class="dropdown" id="notice"><a class="dropdown-toggle" data-toggle="dropdown" href="#">通知管理<span class="caret"></span></a>'.
      			'<ul class="dropdown-menu">'.
      				'<li id="lookNotice"><a href='.__PUBLIC__.'/control/noticeControl.php?method=getAll'.'>查看通知</a></li>'.
         			'<li id="addNotice"><a href='.__PUBLIC__.'/view/notice/noticeEdit.php'.'>新建通知</a></li>'.
      			'</ul>'.
   			'</li>'.
   			'<li id="repair"><a href='.__PUBLIC__.'/control/repairControl.php?method=waitRepair&id='.$_SESSION['estateManager']['villageId'].'>维修管理</a></li>'.
            '<li class="dropdown" id="village"><a class="dropdown-toggle" data-toggle="dropdown" href="#">小区管理<span class="caret"></span></a>'.
               '<ul class="dropdown-menu">'.
                  '<li id="inputHouse"><a href='.__PUBLIC__.'/view/village/inputHouse.php>房屋录入</a></li>'.
                  '<li id="updateHouse"><a href='.__PUBLIC__.'/view/village/updateHouse.php>房屋修改</a></li>'.
               '</ul>'.
            '</li>'.
            '<li class="navbar-right"></li>'.
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