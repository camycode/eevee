define([
    '../models/role',
    '../services/typing'
], function () {

    return ['$scope', 'role', 'typing', function ($scope, role, typing) {


        $scope.roles = [];

        role.setRoleEditor($scope);

        role.getRoles()
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

        $scope.$on('app.role.posted', function (e, data) {
            $scope.roles.unshift(data);
        });

        $scope.openRoleEditor = function () {

            role.openRoleEditor();

        }


    }];

});
