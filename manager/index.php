<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv=Content-Type content="text/html; charset=utf-8">
    <title> Management </title>
    <link rel="stylesheet" href="./css/style.css" media="all" />
    <link rel="stylesheet" href="./css/bootstrap.css" media="all" />
    <link rel="stylesheet" href="./css/sweetalert2.min.css" media="all" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <script src='https://kit.fontawesome.com/a076d05399.js'></script>
    <script src="./js/angular.js"></script>
     <script src="./js/sweetalert2.min.js"></script>
      <script src="./js/bootstrap.js"></script>
     <script src="./js/script.js"></script>
  </head>
  <body ng-app="myApp" ng-controller="myCtrl" onload="onload()">
    <div id="index" style="padding: 50px; padding-top: 20px">
      <div class="panel panel-primary">
        <div class="panel-body">
          <div style="text-align: center">
            <h4>
              จัดการข้อมูล 
              <span ng-if="userData.user_level == 0" style="color: blue;">
               (แอดมิน) 
              </span>
              <span ng-if="userData.user_level == 1" style="color: blue;">
                (เจ้าหน้าที่)
              </span>
              <span ng-if="userData.user_level == 2" style="color: blue;">
                (ผู้ใช้ทั่วไป)
              </span>
            </h4>
          </div>
          <div class="row" ng-if="userData.user_level == 0" style="margin-top: 20px;">
              <div class="col-sm-3">
                <div class="alert alert-success">
                  <div style="float: right">
                    <i class='fas fa-user-cog' style='font-size:24px'></i>
                  </div>
                  <h3><b>{{countUser.user0}}</b></h3>
                  <strong>จำนวนแอดมิน</strong>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="alert alert-info">
                <div style="float: right">
                    <i class='fas fa-user-edit' style='font-size:24px'></i>
                  </div>
                  <h3><b>{{countUser.user1}}</b></h3>
                  <strong>จำนวนเจ้าหน้าที่</strong>
                </div>
              </div>
              <div class="col-sm-3">
                <div class="alert alert-danger">
                <div style="float: right">
                    <i class='fas fa-user-tie' style='font-size:24px'></i>
                  </div>
                  <h3><b>{{countUser.user2}}</b></h3>
                <strong>จำนวนผู้ใช้ทั่วไป</strong> 
                </div>
              </div>
          </div>
          <div class="row" >
              <div class="col-sm-6">
                <button type="button" style="margin-top: 25px" class="btn btn-success" ng-click="doSearch()"> <i class="fa fa-search"></i> แสดงข้อมูล </button>
                <button type="button" style="margin-top: 25px;font-size:16px" class="btn btn-primary btn-sm" ng-click="testConnect()"><i class='fas fa-globe'></i> ทดสอบการเชื่อมต่อ </button>
                <button type="button" style="margin-top: 25px;font-size:16px" class="btn btn-info btn-sm" ng-click="profile()" data-toggle="modal" data-target="#myModal"><i class='fas fa-address-card'></i> โปรไฟล์ </button>
                <button type="button" style="margin-top: 25px;font-size:16px" class="btn btn-default btn-sm" ng-click="doLogout()"><i class='fas fa-sign-out-alt'></i> ออกจากระบบ </button>
              </div>
              <div class="col-sm-5" style="float: right;">
                <label for="SerialNo">ค้นหา:</label>
                <input type="text" ng-model="searchData" class="form-control" id="searchData"  name="searchData">
              </div>
          </div>
          <div class="row">
            <div id="orderInfo" class="col table-responsive-sm">
               <table id="videoInfoTable" class="table table-bordered table-sm">
                <thead>
                  <tr>
                    <th>Index</th>
                    <th>ชื่อ-นามสกุล</th>
                    <th>email</th>
                    <th>เบอร์โทร</th>
                    <th>ระดับผู้ใช้</th>
                    <th width="200">จัดการ</th>
                  </tr>
                </thead>
                <tbody>
                  <tr ng-repeat="x in data | filter : searchData ">
                    <td>{{ $index+1 }}</td>
                    <td>{{ x.fname }} {{ x.lname }}</td>
                    <td>{{ x.email }}</td>
                    <td>{{ x.tel }}</td>
                    <td>
                      <div ng-if="x.user_level == 0">
                       แอดมิน
                      </div>
                      <div ng-if="x.user_level == 1">
                        เจ้าหน้าที่
                       </div>
                       <div ng-if="x.user_level == 2">
                        ผู้ใช้ทั่วไป
                       </div>
                    </td>
                    <th style="text-align: center;" > 
                      <button type="button" class="btn btn-info btn-sm" ng-click="doEdit(x)" data-toggle="modal" data-target="#myModal"> 
                        <i class='fas fa-edit'></i> แก้ไข 
                      </button> 
                      <button type="button" class="btn btn-danger btn-sm" ng-if="userData.user_level != 2" ng-click="doDelete(x)" > 
                        <i class='fas fa-edit'></i> ลบ 
                      </button> 
                    </th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">&times;</button>
              <h4 class="modal-title">แกไขข้อมูล</h4>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="SerialNo">ชื่อ:</label>
                    <input type="text" class="form-control" ng-model="editData.fname"  >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="ProdID">นามสกุล:</label>
                    <input type="text" class="form-control" ng-model="editData.lname"  >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label for="comment">ที่อยู่:</label>
                    <textarea class="form-control" rows="5" ng-model="editData.address"></textarea>
                  </div>
                </div>
              </div>

             
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="SerialNo">เบอร์โทร:</label>
                    <input type="text" class="form-control" ng-model="editData.tel"  >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="ProdID">อีเมล:</label>
                    <input type="text" class="form-control" ng-model="editData.email"  >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="sel1">ระดับผู้ใช้:</label>
                    <select class="form-control" ng-model="editData.user_level" ng-if="userData.user_level != 0" disabled>
                      <option value="0">1. แอดมิน</option>
                      <option value="1">2. เจ้าหน้าที่</option>
                      <option value="2">3. ผู้ใช้ทั่วไป</option>
                    </select>
                    <select class="form-control" ng-model="editData.user_level" ng-if="userData.user_level == 0">
                      <option value="0">1. แอดมิน</option>
                      <option value="1">2. เจ้าหน้าที่</option>
                      <option value="2">3. ผู้ใช้ทั่วไป</option>
                    </select>
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="SerialNo">ref code:</label>
                    <input type="text" class="form-control" ng-model="editData.ref_code"  >
                  </div>
                </div>
              </div>
             
              <div class="row">
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="ProdID">ref remark:</label>
                    <input type="text" class="form-control" ng-model="editData.ref_remark"  >
                  </div>
                </div>
                <div class="col-sm-6">
                  <div class="form-group">
                    <label for="SerialNo">remark:</label>
                    <input type="text" class="form-control" ng-model="editData.remark"  >
                  </div>
                </div>
              </div>
               
              
              <button type="submit" style="margin-top: 20px" class="btn btn-danger "  ng-click="doSave()" >บันทึก</button>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
