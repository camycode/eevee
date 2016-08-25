//  用户模型

App.factory('ajax', ["$http", function ($http) {


    return function (config) {

        config = $.extend({
            headers: {
                "Accept": "application/json",
                "Content-Type": "application/json"
            }
        }, config);

        return $http(config);
        
    };

}]);