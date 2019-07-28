<html  lang="en" ng-app="myApp">
	<head>
		<title> ระบบจัดการข้อมูลสารสนเทศ</title>
		<meta http-equiv=Content-Type content="text/html; charset=utf-8">
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/style.css">
		<script type="text/javascript" src="js/angular.min.js"></script>
		<script type="text/javascript" src="js/jquery-1.11.1.min.js"></script>
		<script type="text/javascript" src="js/script.js"></script>
		<script type="text/javascript" src="js/bootstrap.min.js"></script>
	</head>
	<body ng-controller="mianController" >
		<div id="container" class="panel panel-primary " style="margin: 2%">
			<div class="panel-heading">
				<label style="margin-left:2px">จัดการข้อมูล</label>
				<label style="margin-left:90%;">
				 	<a href="#" style="color: red"> รายงาน</a>
				</label>
			</div>
			<div class="panel-body">
				<div  style="width: 50%;margin: auto;" class="panel panel-default">
					<label style="margin-left:30%;font-size:20px;padding:15px;">กรุณากรอกข้อมูลให้ครบถ้วน</label>
					<form class="form-horizontal" autocomplete = "off" name="myForm">
					    <div class="form-group">
					      <label class="control-label col-sm-2" for="email">ชื่อ:</label>
					      <div class="col-sm-10">
					        <input type="text" class="form-control" id="name" style="width:80%">
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-2" >เพศ:</label>
					      <div class="col-sm-10">
					        <input type="radio" name="sex" value="ชาย" checked>ชาย
			  		    	<input type="radio" name="sex" value="หญิง" >หญิง
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-2">ที่อยู่:</label>
					      <div class="col-sm-10">
					        <textarea id="address" style="height:80px;width:80%"></textarea>
					      </div>
					    </div>
					    <div class="form-group">
					      <label class="control-label col-sm-2">เบอร์โทร</label>
					      <div class="col-sm-10">          
					        <input type="text" class="form-control" id="tel" style="width:80%">
					      </div>
					    </div>
					    <div class="form-group"> 
					      <label class="control-label col-sm-2">อีเมล</label>       
					      <div class="col-sm-10">
					          <input type="text" class="form-control" id="email" style="width:80%">
					      </div>
					    </div>
					    <div class="form-group">        
					      <div class="col-sm-offset-2 col-sm-10">
					        <button type="submit" class="btn btn-default" ng-click="saveData()">บันทึก</button>
					        <button type="submit" class="btn btn-default" ng-click="saveEditData()">แก้ไข</button>
					      </div>
					    </div>
					 </form>
				 </div>
				 <div class="table-responsive " style="width: 70%;margin: auto;margin-top: 2%">          
					  <table class="table">
					    <thead>
						    <tr>
						        <th>#</th>
						        <th>ชื่อ-นามสกุล</th>
						        <th>เพศ</th>
						        <th>ที่อยู่</th>
						        <th>เบอร์โทร</th>
						        <th>อีเมล</th>
						        <th>แก้ไข</th>
						    </tr>
					    </thead>
					    <tbody>
					        <tr ng-repeat="x in data">
					 			<td> {{x.id}} </td>
					 			<td> {{x.name}} </td>
					 			<td> {{x.sex}} </td>
					 			<td> {{x.address}} </td>
					 			<td> {{x.tel}} </td>
					 			<td> {{x.email}} </td>
					 			<td> <a href="#" ng-click="editData(x)">แก้ไขข้อมูล</a> </td>
					 		</tr>
					    </tbody>
					  </table>
					  <div style="margin-top: 2%">
					 	 <button type="submit" class="btn btn-default" style="position: absolute;" ng-click="pData()">หน้าก่อน</button>
					 	 <button type="submit" class="btn btn-default" style="position: relative;
  left: 40%;;"ng-click="report()">ออกรายงาน</button>
					 	 <button type="submit" class="btn btn-default" style=" position: relative;
  left: 70%;" ng-click="nData()">หน้าใหม่</button>
					  </div>
					 
				 </div>


			</div>
		</div>
	</body>
