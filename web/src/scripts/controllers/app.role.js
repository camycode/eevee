define(['app', 'jquery'], function(app) {

  return ['$scope', 'RoleEditor', function($scope, RoleEditor) {
    $scope.title = "用户管理";

    RoleEditor.init($scope);
    $scope.openRoleEditor = function() {
      RoleEditor.open();
      //   $('#pre-selected-options').multiSelect();
    }

  }];

});
