define([
  'app',
  'ajax',
  'jquery'
  '../directives/role.editor'
],function(eevee){
  eevee.factory('role',['$compile','ajax',function($compile,ajax){
    return {
      getRoles : function(){
          return ajax.get('/api/roles');
      },
      setRoleEditor: function($scope){
        $('#layout-view').append($compile($('<div role.editor></div>'))($scope));
      },
      openRoleEditor:function(){
        $("#role-editor").hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();
      }

    },
  }]);
});
