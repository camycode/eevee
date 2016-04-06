/**
 * Users 控制器
 */

define([
  'app',
  '../models/user'
],
function(app){
    return ['$scope','user',function($scope,user) {

      $scope.title = "用户管理";

      user.setUserEditor($scope);

      $scope.openUserEditor = function() {

          user.openUserEditor();
          
      }

    }];
});
