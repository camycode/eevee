define(['app'],function(eevee){

  eevee.factory('ajax',['$http',function($http){
    return {
      get : function(uri,params){
          return $http.get();
      },

    },
  }]);

});
