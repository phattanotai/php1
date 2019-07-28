var app = angular.module('myApp', []);
app.controller('mianController', function($scope,$http) {
        $scope.n=10;
        $scope.p=1;
        $scope.id = 0;
        $http.post(
          "load.php",
           {
            n:$scope.n,
            p:$scope.p
          }
        ).success(function(data){
            $scope.data = data;
        }).error(function(data){
            console.log(data);
        });

   $scope.saveData = function(){
      $scope.name = document.getElementById("name").value;
      $scope.sex= document.forms["myForm"]["sex"].value;
      $scope.address= document.getElementById("address").value;
      $scope.tel= document.getElementById("tel").value;
      $scope.email= document.getElementById("email").value;


      document.getElementById("name").value = '';
      document.getElementById("address").value = '';
      document.getElementById("tel").value = '';
      document.getElementById("email").value = '';


      $http.post(
          "save.php?s=0",
          {
            name: $scope.name,
            sex:$scope.sex,
            address: $scope.address,
            tel: $scope.tel,
            email: $scope.email,
            n:$scope.n,
            p:$scope.p
          }
        ).success(function(data){
            console.log(data) 
            $scope.data = data;
        }).error(function(data){
            console.log(data);
        });
    }
    $scope.saveEditData = function(){
      $scope.name = document.getElementById("name").value;
      $scope.sex= document.forms["myForm"]["sex"].value;
      $scope.address= document.getElementById("address").value;
      $scope.tel= document.getElementById("tel").value;
      $scope.email= document.getElementById("email").value;

      document.getElementById("name").value = '';
      document.getElementById("address").value = '';
      document.getElementById("tel").value = '';
      document.getElementById("email").value = '';
      
      $http.post(
          "save.php?s=1",
          {
            name: $scope.name,
            sex:$scope.sex,
            address: $scope.address,
            tel: $scope.tel,
            email: $scope.email,
            id:$scope.id,
            n:$scope.n,
            p:$scope.p
          }
        ).success(function(data){
            console.log(data) 
            $scope.data = data;
        }).error(function(data){
            console.log(data);
        });

    }
    $scope.editData = function(x){
        document.getElementById("name").value = x.name;
        document.forms["myForm"]["sex"].value = x.sex;
        document.getElementById("address").value = x.address;
        document.getElementById("tel").value = x.tel;
        document.getElementById("email").value = x.email;

        $scope.id = x.id;

    }

    $scope.nData = function(){
        $scope.p+=10;
        $scope.n+=10;
        $http.post(
          "load.php",
          {
            n:$scope.n,
            p:$scope.p
          }
        ).success(function(data){
          if(data.length>0){
              $scope.data = data;
              
          }else{
              $scope.p-=10;
              $scope.n-=10;
          }
          
            
        }).error(function(data){
            console.log(data);
        });
    }
    
    $scope.pData = function(){
        $scope.p-=10;
        $scope.n-=10;

        if($scope.p <=0){
            $scope.p = 1;
            $scope.n = 10;
        }
        $http.post(
          "load.php",
          {
            n:$scope.n,
            p:$scope.p
          }
        ).success(function(data){ 
            $scope.data = data;
        }).error(function(data){
            console.log(data);
        });
    }

    $scope.report = function(){
       window.open('report.php','_blank')
    }


});

function clickMe(){
      name = document.getElementById("name").value;
      sex= document.forms["myForm"]["sex"].value;
      address= document.getElementById("address").value;
      tel= document.getElementById("tel").value;
      email= document.getElementById("email").value;
      $.ajax({     
                type:"post",         
                url: "save.php",
                data:{
                  name: $scope.name,
                  sex:$scope.sex,
                  address: $scope.address,
                  tel: $scope.tel,
                  email: $scope.email
                },          
                success:function(data){
                                  
                      $scope.data = JSON.parse(data);
                       console.log($scope.data)  
  
                }
             });
}