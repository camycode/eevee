define(['app'],function(app) {

  return  app.factory('ajax', ['$http', function($http) {


      var host = 'http://localhost:7800';
      var app_id = 'leshi_2.4.0_29';
      var user_token = 'sccCFgY13Arv_-Du-qO1mPw25iqnHBgO-JrvfqlA';

      var ajax = {
        config: {
          timeout: 10000,
          headers: {
            'Content-Type':'application/json',
            'X-App-ID': app_id,
            'X-User-Token': user_token
          }
        },
        get: function(url, params) {

          ajax.config.method = 'get';
          ajax.config.url = host + url;
          ajax.config.params = params;

          return $http(ajax.config);

        },
        post: function(url, data) {

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
