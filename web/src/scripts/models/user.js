/**
 * 用户模型
 *
 * @author 胡桂华(gue@lehu.io)
 */

define([
        'app',
        'jquery',
        'ajax',
        'user.editor'
    ],
    function (app, $) {

        app.factory('user', ['$compile', 'ajax', function ($compile, ajax) {

            return {
                /**
                 * 判断用否是否登录
                 *
                 * @return bool
                 */
                isLogin: function () {

                },
                /**
                 * 配置用户编辑器
                 *
                 * @param $scope
                 */
                setUserEditor: function ($scope) {
                    $('#eevee-view').append($compile($('<div user.editor></div>'))($scope));
                },
                /**
                 * 打开用户编辑器
                 */
                openUserEditor: function () {
                    $("#app-user-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
                },
                /**
                 * 用户登录
                 *
                 * @param params
                 *
                 * @returns $http
                 */
                login: function (params, success, error) {
                    ajax.post('/api/auth/login', params)
                        .success(function (response) {
                            if (typeof success == 'function') {
                                success(response);
                            }
                        })
                        .error(function (response) {
                            if (typeof error == 'function') {
                                error(response);
                            }
                        });
                },
                /**
                 * 获取用户组
                 */
                getUsers: function (params) {
                    return ajax.get('/api/users', params);
                }

            };


        }]);

    });
