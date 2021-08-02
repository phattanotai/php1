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
  <body ng-app="myApp" ng-controller="myCtrl" >
    <div   id="register"  style=" padding: 50px 100px 50px 100px;">
      <div class="panel panel-primary">
        <div class="panel-body">
          <div style="text-align: center">
            <h4>
              ลงทะเบียนเข้าใช้งานระบบ
            </h4>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="SerialNo"><span style="color: red;">*</span> ชื่อ:</label>
                <input type="text" class="form-control" ng-model="editData.fname"  >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="ProdID"><span style="color: red;">*</span> นามสกุล:</label>
                <input type="text" class="form-control" ng-model="editData.lname"  >
              </div>
            </div>
          </div>

          <div class="row">
            <div class="col-sm-12">
              <div class="form-group">
                <label for="comment"><span style="color: red;">*</span>ที่อยู่:</label>
                <textarea class="form-control" rows="5" ng-model="editData.address"></textarea>
              </div>
            </div>
          </div>

         
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="SerialNo"><span style="color: red;">*</span>เบอร์โทร:</label>
                <input type="text" class="form-control" ng-model="editData.tel"  >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="ProdID"><span style="color: red;">*</span>อีเมล:</label>
                <input type="text" class="form-control" ng-model="editData.email"  >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="SerialNo"><span style="color: red;">*</span>Username:</label>
                <input type="text" class="form-control" ng-model="editData.username"  >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="ProdID"><span style="color: red;">*</span>Password:</label>
                <input type="password" class="form-control" ng-model="editData.password"  >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="ProdID"><span style="color: red;">*</span>Re-Password:</label>
                <input type="password" class="form-control" ng-model="editData.repassword"  >
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6">
              <div class="form-group">
                <label for="SerialNo">ref code:</label>
                <input type="text" class="form-control" ng-model="editData.ref_code"  >
              </div>
            </div>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="ProdID">ref remark:</label>
                <input type="text" class="form-control" ng-model="editData.ref_remark"  >
              </div>
            </div>
          </div>
         
          <div class="row">
           
            <div class="col-sm-6">
              <div class="form-group">
                <label for="SerialNo">remark:</label>
                <input type="text" class="form-control" ng-model="editData.remark"  >
              </div>
            </div>
          </div>
           
          <a ng-click="goToLogin()">
            Login
          </a>
          <button type="submit"  class="btn btn-default "  ng-click="doRegister()" >บันทึก</button>
        </div>
        
      </div>
          
        </div>
      </div>
      
    </div>
  </body>
</html>
