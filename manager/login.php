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
    
    <div id="login"   style=" padding: 200px 450px 75px 450px;">
      
      <div class="panel panel-primary">
        <div class="panel-body">
          <div style="text-align: center">
            <h4>
              เข้าสู้ระบบ 
            </h4>
          </div>
          <!-- <span class="header-mask  opacity-9"></span> -->
            <form >
                <div class="form-group">
                  <label for="username">Username:</label>
                  <input type="text" class="form-control" ng-model="loginData.username" id="username">
                </div>
                <div class="form-group">
                  <label for="password">Password:</label>
                  <input type="password" class="form-control" ng-model="loginData.password" id="password">
                </div>
               <a ng-click="goToRegister()">
                   Register
               </a>
                <button type="button" class="btn btn-default" ng-click="doLogin()">Login</button>
              </form>
        </div>
      </div>
    </div>

  </body>
</html>
