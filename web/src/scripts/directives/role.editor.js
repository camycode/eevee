/**
 * 角色编辑器指令
 */
define([
        'app',
        'role',
        'user',
        'typing',
        'css!../css/directives/role.editor'
    ],
    function (app) {

        app.directive('role.editor', function () {

            return {
                restrict: 'A',
                replace: true,
                scope: {},
                templateUrl: 'views/directives/role.editor.html',
                controller: ['$scope', 'role', 'user', 'typing', function ($scope, role, user, typing) {

                    $scope.title = "编辑用户";

                    $scope.role = {
                        id: '',
                        name: '',
                        description: '',
                        permissions: []
                    };

                    $scope.permissions = [];

                    role.getRolePermissions(user.info().role)
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


                    $scope.editRole = function () {

                        role.postRole($scope.role)
                            .success(function (response) {

                                if (response.code == 200) {
                                    typing.success('成功添加角色');
                                } else {
                                    typing.warning(response.message);
                                }

                            })
                            .error(function () {

                                typing.error('网络错误');

                            });
                    };


                    $scope.closePostEditor = function () {

                        $("#directive-role-editor").addClass('animated slideOutRight');

                    };

                }]
            };

        });

    });
