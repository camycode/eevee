/**
 * 存储服务
 *
 * author : 胡桂华
 * time   : 2016/04
 *
 *
 */

define([
        'app'
    ],
    function (app) {

        app.factory('storage', ['$http', function ($http) {

            var cookie = {};

            var storage = {
                cookie: cookie,

                set: function (key, value) {
                    localStorage.setItem(key, value);
                },
                get: function (key) {
                    return localStroage[key] == 'undefined' ? undefined : localStroage[key];
                },
                has: function (key) {
                    return typeof localStorage[key] != 'undefined';
                },
                remove: function (key) {
                    localStorage.removeItem(key);
                }
            };

            return storage;

        }]);
    });
