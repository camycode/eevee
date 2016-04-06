/**
 * Posts 控制器
 */
define([
    'app',
    '../models/user',
    '../services/storage',
    '../services/typing',
    'css!../../css/pages/login'
  ],
  function(app) {

    return ['$scope', '$state', 'user', 'storage', 'typing', function($scope, $state, user, storage, typing) {

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

            } else {

              typing.warning(response.message);

            }

          });
      };

    }];
  });
