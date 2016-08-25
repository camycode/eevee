//  用户模型

App.factory('user', ["$http", "ajax", function ($http, ajax) {

    return {
        /**
         * 获取用户组
         *
         * @param params object
         *
         * @returns $http
         */
        getUserList: function (params) {

            return ajax({
                method: 'GET',
                url: '/api/user/list'
            });
        },
        /**
         * 获取用户
         *
         * @param id string
         */
        getUser: function (id) {


        }
    };
}]);