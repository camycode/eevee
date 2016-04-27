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
                    $('#layout-view').append($compile($('<div user.editor></div>'))($scope));
                },
                /**
                 * 打开用户编辑器
                 */
                openUserEditor: function () {
                    $("#user-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
                },
                /**
                 * 用户登录
                 *
                 * @param params
                 *
                 * @returns $http
                 */
                login: function (params) {
                    return ajax.post('/api/auth/login', params);
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
