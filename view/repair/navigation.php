<?php
echo '<div class="col-sm-3">'.
		'<ul class="nav nav-pills nav-stacked">'.
			'<li class="active"><a href='.__PUBLIC__.'/control/repairControl.php?method=waitRepair&id='.$_SESSION['estateManager']['villageId'].'>待维修列表</a></li>'.
			'<li><a href='.__PUBLIC__.'/control/repairControl.php?method=haveRepair&id='.$_SESSION['estateManager']['villageId'].'>已维修列表</a></li>'.
		'</ul>'.
	 '</div>';
?>
