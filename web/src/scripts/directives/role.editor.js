/**
 * 角色编辑器指令
 */
define([
        'app',
        'role',
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
                controller: ['$scope', 'role', 'typing', function ($scope, role, typing) {

                    $scope.title = "编辑用户";

                    $scope.role = {
                        id: '',
                        name: '',
                        description: '',
                        permissions: []
                    };


                    $scope.editRole = function () {

                        role.postRole($scope.role)
                            .success(function (response) {

                                if(response.code == 200){
                                    typing.success('成功添加角色');
                                }else{
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
