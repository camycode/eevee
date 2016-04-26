define([
  'app',
  'jquery',
  'ajax',
  'role.editor'
], function(app, $) {

  app.factory('role', ['$compile', 'ajax', function($compile, ajax) {

    return {

      getRoles: function() {
        return ajax.get('/api/roles');
      },

      setRoleEditor: function($scope) {
        $('#layout-view').append($compile($('<div role.editor></div>'))($scope));
      },

      openRoleEditor: function() {
        console.log($("#role-editor").attr('id'));
        $("#role-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
      }

    };

  }]);

});
