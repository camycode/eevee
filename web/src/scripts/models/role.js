define([
  'app',
  'ajax',
],function(eevee){
  eevee.factory('role',['ajax',function(ajax){
    return {
      getRoles : function(){
          return ajax.get('/api/roles');
      },

    },
  }]);
});
