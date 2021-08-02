  var app = angular.module("myApp", []);
  app.controller("myCtrl", function ($scope, $http) {
    $scope.searchData = '';
    $scope.data = {};
    $scope.editData = {
      fname: '',
      lname: '',
      address: '',
      tel: '',
      email: '',
      username: '',
      password: '',
      repassword: '',
      ref_code: '',
      ref_remark: '',
      remark: ''
    };
    $scope.loginData = {};
    $scope.userData = JSON.parse(localStorage.getItem('loginData'));
    $scope.countUser = {
      user0: 0,
      user1: 0,
      user2: 0
    }
    var headers = {
        'Content-Type': 'application/json',
        Authorization: localStorage.getItem('token'),
    };

    $scope.testConnect = function () {
      $http({
          url: 'service/test/testConnect',
          method: 'GET',
          dataType: 'json',
          headers,
        }).then(function (res) {
          swal({ 
                text: res.data.massage, 
                type: 'success', 
                showCancelButton: true, 
                confirmButtonColor: '#3085d6', 
                cancelButtonColor: '#d33', 
                confirmButtonText: 'Yes, send me there!' 
                }
            ); 
        });
    };

    $scope.doEnter = function(event) {    
      if(event.which === 13){
         $scope.doSearch();
      }
    }
    $scope.doSearch = function () {
      $http({
          url: 'service/member/getMember',
          method: 'GET',
          dataType: 'json',
          headers,
        }).then(function (res) {
            if(res.data.massage === 'ok'){
              $scope.data = res.data.data;
              for(const i of res.data.data){
                if(i.user_level == 0){
                  $scope.countUser.user0++;
                }
                if(i.user_level == 1){
                  $scope.countUser.user1++;
                }
                if(i.user_level == 2){
                  $scope.countUser.user2++;
                }
              }
            }else{
              localStorage.setItem('token','');
              swal({ 
                text: res.data.data, 
                type: 'success', 
                showCancelButton: true, 
                confirmButtonColor: '#3085d6', 
                cancelButtonColor: '#d33', 
                confirmButtonText: 'Yes, send me there!' 
                }
            ); 
            setTimeout(() => {
              window.location.replace("/manager/login.php");
            },2000);
               
            }
        });
    }
    $scope.doDelete = function (data) {
      swal({
        title: 'ยืนยันการลบ',
        text: 'คุณต้องการลบข้อมูลใช่ หรือไม่!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'แก้ไขข้อมูล',
      }).then(result => {     
        if (result) {
          $http({
            url: 'service/member/deleteMember',
            method: 'POST',
            dataType: 'json',
            data: data,
            headers,
          }).then(function (res) {
              console.log((res.data));
              if(res.data.massage === 'ok'){
                $scope.data = res.data.data;
                setTimeout(() => {
                  $scope.doSearch();
                },1000);
                   
              }else{
                localStorage.setItem('token','');
                swal({ 
                  text: res.data.data, 
                  type: 'success', 
                  showCancelButton: true, 
                  confirmButtonColor: '#3085d6', 
                  cancelButtonColor: '#d33', 
                  confirmButtonText: 'Yes, send me there!' 
                }); 
             
              }
          });
        }
      });
    }

    $scope.doLogout = function(){
      localStorage.setItem('token','');
      swal({ 
        text: 'ออกจากระบบแล้ว', 
        type: 'success', 
        showCancelButton: true, 
        confirmButtonColor: '#3085d6', 
        cancelButtonColor: '#d33', 
        confirmButtonText: 'Yes, send me there!' 
        }
      ); 
      setTimeout(() => {
        window.location.replace("/manager/login.php");
      },1000);
   
    }
    $scope.doLogin = function () {
      $http({
          url: 'service/member/doLogin',
          method: 'POST',
          dataType: 'json',
          headers,
          data: $scope.loginData,
        }).then(function (res) {
          if(res.data.data){
            localStorage.setItem('token',res.data.data.token);
            localStorage.setItem('loginData',JSON.stringify(res.data.data));
            $scope.userData = res.data.data;
            swal({ 
              text: 'ยินดีต้อนรับเข้าสู่ระบบ', 
              type: 'success', 
              showCancelButton: true, 
              confirmButtonColor: '#3085d6', 
              cancelButtonColor: '#d33', 
              confirmButtonText: 'Yes, send me there!' 
              }
            ); 
            setTimeout(() => {
              window.location.replace("/manager/");
            },2000);
          }else{
            swal({ 
              text: 'กรุณาตรวจสอบ username หรือ password ', 
              type: 'warning', 
              showCancelButton: true, 
              confirmButtonColor: '#3085d6', 
              cancelButtonColor: '#d33', 
              confirmButtonText: 'Yes, send me there!' 
              }
            ); 
          }
          
        });
    }
    $scope.doEdit = function (data) {
      $scope.editData = data;
    }
    $scope.profile = function(){
      $scope.editData = $scope.userData;;
    }
    $scope.doRegister = function () {
      if($scope.editData.fname != '' && $scope.editData.lname != '' && $scope.editData.email != '' && $scope.editData.tel != '' && $scope.editData.username != '' && $scope.editData.password != ''){
        if($scope.editData.password === $scope.editData.repassword){
          swal({
            title: 'ยืนยันการบันทึก',
            text: 'ตรวจสอบข้อมูลให้ถูกต้อง!',
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'แก้ไขข้อมูล',
          }).then(result => {     
            if (result) {
              $http({
                url: 'service/member/addMember',
                method: 'POST',
                dataType: 'json',
                headers,
                data: $scope.editData,
              }).then(function (res) {
                if(res.data.massage === 'ok'){
                  swal({ 
                    text: res.data.data, 
                    type: 'success', 
                    showCancelButton: true, 
                    confirmButtonColor: '#3085d6', 
                    cancelButtonColor: '#d33', 
                    confirmButtonText: 'Yes, send me there!' 
                  }); 
                  $scope.editData = {
                    fname: '',
                    lname: '',
                    address: '',
                    tel: '',
                    email: '',
                    username: '',
                    password: '',
                    repassword: '',
                    ref_code: '',
                    ref_remark: '',
                    remark: ''
                  };
                }else{
                  swal({ 
                    text: res.data.data.isUsername + ' \n' + res.data.data.isName + ' \n' + res.data.data.isTel + ' \n' + res.data.data.isEmail  , 
                    type: 'warning', 
                    showCancelButton: true, 
                    confirmButtonColor: '#3085d6', 
                    cancelButtonColor: '#d33', 
                    confirmButtonText: 'Yes, send me there!' 
                    }
                ); 
                }
               
              });
            }
          });
        }else{
          swal({ 
            text: 'รหัสผ่านไม่ตรงกัน', 
            type: 'success', 
            showCancelButton: true, 
            confirmButtonColor: '#3085d6', 
            cancelButtonColor: '#d33', 
            confirmButtonText: 'Yes, send me there!' 
            }
        ); 
        }
      }else{
        swal({ 
          text: 'ข้อมูลไม่ครบ', 
          type: 'success', 
          showCancelButton: true, 
          confirmButtonColor: '#3085d6', 
          cancelButtonColor: '#d33', 
          confirmButtonText: 'Yes, send me there!' 
          }
      ); 
      }
   }

    $scope.doSave = function () {
       swal({
        title: 'ยืนยันการแก้ไข',
        text: 'ตรวจสอบข้อมูลให้ถูกต้อง!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'แก้ไขข้อมูล',
      }).then(result => {     
        if (result) {
          $http({
            url: 'service/member/updateMember',
            method: 'POST',
            dataType: 'json',
            headers,
            data: $scope.editData,
          }).then(function (res) {
            swal({ 
                text: res.data.massage, 
                type: 'success', 
                showCancelButton: true, 
                confirmButtonColor: '#3085d6', 
                cancelButtonColor: '#d33', 
                confirmButtonText: 'Yes, send me there!' 
                }
            ); 
          });
        }
      });
    }

    $scope.goToRegister = function (data) {
      window.location.replace("/manager/register.php");
    }

    $scope.goToLogin = function (data) {
      window.location.replace("/manager/login.php");
    }
    // ---------------------------------------------------
  });


  function onload(){
     var token = localStorage.getItem('token');
     if(!token){
      window.location.replace("/manager/login.php");
     }
   }