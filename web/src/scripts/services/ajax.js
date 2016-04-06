/**
 * ajax service
 *
 * author : 胡桂华
 * time   : 2016/03/09
 *
 * API调用需要传入额外的头部参数，判断请求的合法性，故对ajax请求封装成了此服务。
 * 函数提供了全局配置参数，提供给API升级时使用。
 *
 * TODO：请求方法中，应该传入第三个配置参数，可根据具体需求改写config。
 *
 */

define([
    'app'
  ],
  function(app) {

    app.factory('ajax', ['$http', function($http) {


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
