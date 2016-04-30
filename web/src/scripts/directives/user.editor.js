/**
 * user.editor 指令
 */
define([
        'app',
        'role',
        'user',
        'typing',
        'css!../css/directives/user.editor'
    ],
    function (app) {

        app.directive('user.editor', function () {

            return {
                restrict: 'A',
                replace: true,
                scope: {},
                templateUrl: 'views/directives/user.editor.html',
                controller: ['$scope', 'role', 'user', 'typing', function ($scope, role, user, typing) {
                    $scope.title = "编辑用户";

                    $scope.roles = [];

                    $scope.user = {
                        'username': '',
                        'password': '',
                        'email': '',
                        'role': 'guest'
                    };

                    role.getRoles()
                        .success(function (response) {

                            if (response.code == 200) {
                                $scope.roles = response.data;
                            } else {
                                typing.warning(response.message);
                            }

                        })
                        .error(function () {
                            typing.error('获取角色组网络错误');
                        });

                    var closeUserEditor = function () {

                        $("#directive-user-editor").addClass('animated slideOutRight');
                    };

                    $scope.editUser = function () {

                        console.log($scope.user);
                        user.postUser($scope.user)
                            .success(function (response) {

                                if (response.code == 200) {
                                    typing.success('用户添加成功');
                                    closeUserEditor();
                                } else {
                                    typing.warning(response.message);
                                }

                            })
                            .error(function () {

                                typing.error('网络错误');

                            });

                    };

                    $scope.closePostEditor = function () {

                        closeUserEditor();

                    };

                }]
            };

        });

    });
