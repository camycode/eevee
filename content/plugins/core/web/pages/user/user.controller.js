// 定义模块
var App = angular.module('user', []);

// 定义控制器
App.controller('userController', ['$scope', 'user', function ($scope, user) {

    $scope.done = false;

    user.getUserList()
        .success(function (res) {

            if(res.code == 200){
                $scope.users = res.data;
                $scope.done = true;
            }

        })
        .error(function (res) {

        });

}]);

