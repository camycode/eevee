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

    app.factory('storage', ['$http', function($http) {


      var storage = {
        set:function(key,value){
          localStroage.key = value;
        }
      };

      return storage;

    }]);
  });
