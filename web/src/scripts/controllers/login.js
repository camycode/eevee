/**
 * Posts 控制器
 */
define(['app', '../models/user', '../services/storage', 'css!../../css/pages/login'], function(eevee) {
  return ['$scope', '$state', 'user', 'storage', 'storage', function($scope, $state, user, storage) {

    $scope.account = null;
    $scope.password = null;

    $scope.login = function() {

      user.login({
          account: $scope.account,
          password: $scope.password
        })
        .success(function(response) {

          if (response.code == 200) {
            $state.go('app.post');
          }

        });
    };

  }];
});
