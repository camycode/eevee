/**
 * 资产模型
 *
 * @author 胡桂华(gue@lehu.io)
 */

define([
    'app',
    'jquery',
    'ajax',
    'user.editor'
  ],
  function(app, $) {

    app.factory('user', ['$compile', 'ajax', function($compile, ajax) {

      return {
        /**
         * 判断用否是否登录
         *
         * @return bool
         */
        isLogin: function() {

        },
        setUserEditor: function($scope) {
          $('#layout-view').append($compile($('<div user.editor></div>'))($scope));
        },
        openUserEditor: function() {
          $("#user-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
        },
        login: function(params) {
          return ajax.post('/api/auth/login', params);
        }

      };


    }]);
    
  });
