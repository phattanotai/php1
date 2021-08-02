  var app = angular.module("myApp", []);
  app.controller("myCtrl", function ($scope, $http) {
    $scope.searchData = '';
    $scope.data = {};
    $scope.editData = {};
    var headers = {
      headers: {
        'Content-Type': 'Content-Type: application/json'
      }
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
      let a = $scope.searchData
      if(a == ''){
        a = 'all';
      }
      $http({
          url: 'service/serial/getSerial/' + a,
          method: 'GET',
          dataType: 'json',
          headers,
        }).then(function (res) {
           //  console.log(typeof(res.data));
           // console.log(res.data);
            $scope.data = res.data;
          
        });
    }
    $scope.doEdit = function (data) {
      $scope.editData = data;
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
            url: 'service/serial/updateSerial',
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

   
    // ---------------------------------------------------
  });


   