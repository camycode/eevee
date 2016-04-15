define([
  'app',
  '../models/role',
  '../services/typing',
], function(app) {

  return ['$scope', 'role', 'typing', function($scope, role, typing) {


    $scope.roles = null;

    role.setRoleEditor($scope);

    role.getRoles()
      .success(function(response) {
        if (response.code == 200) {
          $scope.roles = response.data;
        } else {
          typing.warning(response.message);
        }
      })
      .error(function(response) {
        typing.error(response);
      });

    $scope.openRoleEditor = function() {

      role.openRoleEditor();

    }

  }];

});
