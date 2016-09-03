// 定义模块
var App = angular.module('user', []);

// 定义控制器
App.controller('userController', ['$scope', 'user', function ($scope, user) {

    
    var sortField = 'updated_at';

    var sortRule = 'desc';

    var limit = 10;

    var offset = 0;

    var sort = {
        username: null,
        email: null,
        role: null,
        status: null,
        updated_at: null
    };


    $scope.offsetStart = offset;

    $scope.offsetEnd = offset + limit;

    $scope.users = [];

    $scope.userTotal = null;


    var getUserList = function (params) {

        user.getUserList(params)
            .success(function (response) {

                if (response.code == 200) {

                    $scope.users = response.data;

                } else {
                    typing.warning(response.message);
                }

            })
            .error(function () {


            });

    };
    
    user.getUserList({
        count: true
    })
        .success(function (response) {
            $scope.userTotal = response.data;
        })
        .error(function () {

        });

    getUserList({
        order: sortField + ':' + sortRule,
        limit: limit
    });

    $scope.sort = $.extend({}, sort);

    $scope.sortBy = function (field) {

        if (sortField == field) {
            sortRule = sortRule == 'asc' ? 'desc' : 'asc';
        }

        $scope.sort = $.extend({}, sort);

        sortField = field;

        $scope.sort[field] = sortRule == 'asc' ? 'sort ascending' : 'sort descending';

        getUserList({
            order: field + ':' + sortRule,
            limit: limit
        });

    };

    $scope.nextPage = function () {

        var start = offset + limit;

        if (start < $scope.userTotal) {

            offset = start;

            $scope.offsetStart = offset;
            $scope.offsetEnd = $scope.offsetStart + limit;

            getUserList({
                order: sortField + ':' + sortRule,
                limit: limit,
                offset: offset
            });
        }

    };

    $scope.lastPage = function () {

        var start = offset - limit;

        if (start >= 0) {

            offset = start;

            $scope.offsetStart = offset;
            $scope.offsetEnd = $scope.offsetStart + limit;

            getUserList({
                order: sortField + ':' + sortRule,
                limit: limit,
                offset: offset
            });
        }

    };

}]);

