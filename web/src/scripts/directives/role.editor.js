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

                    var init = {
                        name: '',
                        description: '',
                        permissions: []
                    };

                    $scope.role = init;

                    $scope.permissions = {};

                    role.getRolePermissions(user.info().role)
                        .success(function (response) {
                            if (response.code == 200) {
                                $scope.permissions = response.data;
                                $scope.loadPermissionsDone = true;
                            } else {
                                typing.warning(response.message);
                            }
                        })
                        .error(function () {
                            typing.error('网络错误');
                        });


                    $scope.submitRole = function () {

                        $scope.role.parent = user.info().role;

                        role.postRole($scope.role)
                            .success(function (response) {

                                if (response.code == 200) {

                                    typing.success('角色添加成功');

                                    $scope.$emit('app.role.posted', response.data);

                                    $scope.role = init;

                                } else if (response.code == 2001) {

                                    for (var i in response.data) {
                                        typing.warning(response.data[i][0]);
                                    }

                                } else {
                                    typing.warning(response.message);
                                }

                            })
                            .error(function () {

                                typing.error('网络错误');

                            });
                    };

                    $scope.clickPermission = function (index, permission_id) {

                        if (typeof $scope.permissions[index] != 'undefined') {
                            for (var i in $scope.permissions[index].permissions) {
                                if ($scope.permissions[index].permissions[i].id == permission_id) {
                                    if (typeof $scope.permissions[index].permissions[i].checked == 'undefined') {

                                        $scope.permissions[index].permissions[i].checked = 'primary';
                                        $scope.permissions[index].permissions[i].icon = 'checkmark';
                                        $scope.role.permissions.push(permission_id);

                                    } else {

                                        delete $scope.permissions[index].permissions[i].checked;
                                        delete $scope.permissions[index].permissions[i].icon;
                                        for (var i in $scope.role.permissions) {
                                            if ($scope.role.permissions[i] == permission_id) {
                                                $scope.role.permissions.splice(i, 1);
                                            }
                                        }

                                    }
                                }
                            }
                        }
                    };


                    $scope.closePostEditor = function () {

                        $("#directive-role-editor").addClass('animated slideOutRight');

                    };

                }]
            };

        });

    });
