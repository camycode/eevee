define(['app', 'json!../config.json', 'storage'], function (app, config) {

    return app.factory('ajax', ['$http', 'storage', function ($http, storage) {


        var host = 'http://localhost:7800';

        var app_id = config.app_id;

        var user_token = null;

        if (storage.has('APP_LOGIN_USER')) {

            user_token = JSON.parse(storage.get('APP_LOGIN_USER')).user_token;
        }

        var ajax = {
            config: {
                timeout: 10000,
                headers: {
                    'Content-Type': 'application/json',
                    'X-App-ID': app_id,
                    'X-User-Token': user_token
                }
            },
            get: function (url, params) {

                ajax.config.method = 'get';
                ajax.config.url = host + url;
                ajax.config.params = params;

                return $http(ajax.config);

            },
            post: function (url, data) {

                data = data || {};

                ajax.config.method = 'post';
                ajax.config.url = host + url;
                ajax.config.data = data;

                return $http(ajax.config);
            }
        };

        return ajax;

    }]);

});
