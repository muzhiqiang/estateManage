<?php
	 echo '<ul class="nav nav-pills">'.
         '<li id="index"><a href='.__PUBLIC__.'/view/assistant/index.php'.'>首页</a></li>'.
         '<li class="dropdown" id="user"><a class="dropdown-toggle" data-toggle="dropdown" href="#">用户录入<span class="caret"></span></a>'.
               '<ul class="dropdown-menu">'.
                  '<li id="addUser"><a href='.__PUBLIC__.'/view/assistant/addUser.php>添加用户</a></li>'.
                  '<li id="userFile"><a href='.__PUBLIC__.'/control/assistantControl.php?method=getFiles>用户资料</a></li>'.
               '</ul>'.
            '</li>'.
         '<li><a href='.__PUBLIC__.'/control/assistantControl.php?method=logout'.'>退出</a></li>'.
   '</ul>'.
   '<hr>';
?>
  