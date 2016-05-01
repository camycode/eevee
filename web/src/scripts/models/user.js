/**
 * 用户模型
 *
 * @author 胡桂华(gue@lehu.io)
 */

define([
        'app',
        'jquery',
        'ajax',
        'storage',
        'user.editor'
    ],
    function (app, $) {

        app.factory('user', ['$compile', 'ajax', 'storage', function ($compile, ajax, storage) {

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
                    $("#directive-user-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
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

                                storage.set('APP_LOGIN_USER', JSON.stringify(response.data));

                                success(response);
                            }
                        })
                        .error(function (response) {
                            if (typeof error == 'function') {
                                error(response);
                            }
                        });
                },

                isLogin: function () {
                    return storage.has('APP_LOGIN_USER');
                },
                info: function () {
                    return JSON.parse(storage.get('APP_LOGIN_USER'));
                },
                logout: function (callback) {

                    storage.remove('APP_LOGIN_USER');

                    if (typeof callback == 'function') {
                        callback();
                    }
                },
                /**
                 * 获取用户组
                 */
                getUsers: function (params) {
                    return ajax.get('/api/users', params);
                },
                /**
                 * 添加用户
                 *
                 * @param data Object
                 *
                 * @returns $http
                 */
                postUser: function (data) {
                    return ajax.post('/api/user', data)
                }

            };


        }]);

    });
