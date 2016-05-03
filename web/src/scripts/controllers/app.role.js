define([
    '../models/role',
    '../services/typing'
], function () {

    return ['$scope', 'role', 'typing', function ($scope, role, typing) {


        $scope.roles = [];

        role.setRoleEditor($scope);


        var sort = {
            name: null,
            permission_amount: null,
            status: null
        };

        var sortField = null;

        var sortRule = 'asc';

        $scope.sort = $.extend({}, sort);


        var getRoles = function (params) {
            params = params || null;
            role.getRoles(params)
                .success(function (response) {
                    if (response.code == 200) {
                        $scope.roles = response.data;
                    } else {
                        typing.warning(response.message);
                    }
                })
                .error(function () {
                    typing.error('网络错误');
                });
        };

        $scope.sortBy = function (field) {

            if (sortField == field) {
                sortRule = sortRule == 'asc' ? 'desc' : 'asc';
            }

            $scope.sort = $.extend({}, sort);

            sortField = field;

            $scope.sort[field] = sortRule == 'asc' ? 'sort ascending' : 'sort descending';

            getRoles({
                order: field + ':' + sortRule
            });
        };


        getRoles();


        $scope.$on('app.role.posted', function (e, data) {
            $scope.roles.unshift(data);
        });


        $scope.openRoleEditor = function () {

            role.openRoleEditor();

        }


    }];

});
