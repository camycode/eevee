/**
 * user.detail directive
 */
define(
    [
        'app',
        'role',
        'typing',
        'css!../css/directives/role.detail'
    ],
    function (app) {

        app.directive('role.detail', function () {
            return {
                restrict: 'A',
                replace: true,
                templateUrl: 'views/directives/role.detail.html',
                controller: ['$scope', 'role', 'typing', function ($scope, role, typing) {

                    $scope.role = {};

                    $scope.permissions = {};

                    var closeUserEditor = function () {
                        $('#directive-role-detail').addClass('animated slideOutRight');
                    };

                    $scope.$on('app.role.detail.show', function (e, role_id) {
                        $('#directive-role-detail').hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();

                        role.getRole(role_id)
                            .success(function (response) {
                                if (response.code == 200) {
                                    $scope.role = response.data;
                                } else {
                                    typing.warning(response.message);
                                }
                            })
                            .error(function () {
                                typing.error('网络错误');
                            });

                        role.getRolePermissions(role_id)
                            .success(function (response) {
                                if (response.code == 200) {
                                    $scope.permissions = response.data;
                                } else {
                                    typing.warning(response.message);
                                }
                            })
                            .error(function () {
                                typing.error('网络错误');
                            });

                    });

                    $scope.closePostEditor = function () {

                        closeUserEditor();

                    };
                }]
            };
        });

    })
  
