define([
        '../models/user',
        'css!../../css/app.user'
    ],
    function () {

        return ['$scope', 'user', function ($scope, user) {

            $scope.title = "用户管理";

            user.setUserEditor($scope);

            $scope.openUserEditor = function () {

                user.openUserEditor();

            }

        }];

    });
