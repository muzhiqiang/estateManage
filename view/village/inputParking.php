<?php
	require_once('../estateManager/head.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>房屋录入</title>
	<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
  <link href="http://apps.bdimg.com/libs/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
  <script src="http://apps.bdimg.com/libs/jquery/2.0.0/jquery.min.js"></script>
  <script src="http://apps.bdimg.com/libs/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script type="text/javascript">
    	var i = 0;
    	var j = 0;
    	var floor = 0;
    	var floors = 0;
    	var unit = 0;
    	var units = 0;
    	function addBuilding(){
    		$("#addBuilding").remove();
    		$("#building").append("<div class='input-group col-sm-4'><input type='text' class='form-control' name='building'><span class='input-group-addon'>栋</span></div>");
    		$("#floorButton").append("<button class='btn btn-default' onclick='addFloor()'>添加单个楼层</button><button class='btn btn-default' onclick='addFloors()'>添加多个楼层</button>");		
    	};
    	function addUnitButton(){
    		$("#unitButton").append("<button class='btn btn-default' onclick='addUnit()'>添加单个单元</button><button class='btn btn-default' onclick='addUnits()'>添加多个单元</button>")
    	};
    	function addSubmit(){
    		$("#content").append(" <div class='form-group'><button type='submit' class='btn btn-primary' onclick='check()'>确定</button></div>");
    	}
    	function addFloor(){
    		floor++;
    		$("#floor").append("<div class='input-group col-sm-4'><input type='text' class='form-control' name='floor"+floor+"'><span class='input-group-addon'>层</span></div>")
    		
    		if(i==0){
    			addUnitButton();
    			i++;
    		}
    	};
    	function addFloors(){
    		floors++;
    		$("#floor").append("<div class='input-group col-sm-4'><input type='text' class='form-control' name='floors"+floors+"'><span class='input-group-addon'>~</span><input type='text' class='form-control' name='floors"+(++floors)+"'><span class='input-group-addon'>层</span></div>")
    		if(i==0){
    			addUnitButton();
    			i++;
    		}
    	};
    	function addUnit(){
    		unit++;
    		$("#unit").append("<div class='input-group col-sm-4'><input type='text' class='form-control' name='unit"+unit+"'><span class='input-group-addon'>单元</span></div>");
    		
    		if(j==0){
    			addSubmit();
    			j++;
    		}
    	};
    	function addUnits(){
    		units++;
    		$("#unit").append("<div class='input-group col-sm-4'><input type='text' class='form-control' name='units"+units+"'><span class='input-group-addon'>~</span><input type='text' class='form-control' name='units"+(++units)+"'><span class='input-group-addon'>单元</span></div>");
    		if(j==0){
    			addSubmit();
    			j++;
    		}
    	};
    	function check(){
    		$("input").each(function(){
    			if($(this).val()==""){
    				alert("值不能为空");
    				abort();
    			}
    		});
    		$("#content").append("<input value="+floors+" name=floorsNum type='hidden'/>");
    		$("#content").append("<input value="+units+" name=unitsNum type='hidden'/>");
    		$("#content").append("<input value="+floor+" name=floorNum type='hidden'/>");
    		$("#content").append("<input value="+unit+" name=unitNum type='hidden'/>");
    		while(floors>0){
    			var floorsName1 = "floors"+floors;
    			var floorsName2 = "floors"+(--floors);  		
    			if($("input[name="+floorsName1+"]").val() <= $("input[name="+floorsName2+"]").val()){
    				alert("楼层输入错误");
    				abort();
    			}
    			--floors;
    		}
    		while(units>0){    		
    			if($("input[name=units"+units+"]").val() <= $("input[name=units"+(--units)+"]").val()){
    				alert("单元输入错误");
    				abort();
    			}
    			units--;
    			
    		}
    	};
    </script>
</head>
<body>
	
	<?php require_once('../estateManager/navigation.php');?>
	<script type="text/javascript">
		document.getElementById('village').setAttribute('class','dropdown active');
		document.getElementById('inputParking').setAttribute('class','active');
	</script>

	<div class="container">
   		<div class="jumbotron" align="center">
   			<button class="btn btn-default" id="addBuilding" onclick="addBuilding()">添加栋</button>
   			<div id="floorButton">
   				
   			</div>
   			<hr>
   			<div id="unitButton">
   				
   			</div>
   			<hr>
   			<form role="form" method="POST" action=<?php echo __PUBLIC__.'/control/villageControl.php?method=inputParking&id='.$_SESSION['estateManager']['villageId'];?> id="content">
   				<div id="building">
   					
   				</div>
   				<hr>
      			<div id="floor">
      				
      			</div>
      			<hr>
      			<div id="unit">
      				
      			</div>
      			<hr>
      		</form>
  		</div>
	</div>
</body>
</html>