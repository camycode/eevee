define([
        'role',
        'user',
        'typing',
        'css!../../css/app.user'
    ],
    function () {

        return ['$scope', 'typing', 'user', function ($scope, typing, user) {

            $scope.title = "用户管理";

            $scope.users = [];

            user.setUserEditor($scope);

            user.setUserDetail($scope);

            $scope.openUserEditor = function () {
                $scope.$emit('app.user.editor.show');
            };


            $scope.openUserDetailView = function (user_id) {
                $scope.$emit('app.user.detail.show', user_id);
            };

            $scope.$on('app.user.posted', function (e, data) {
                $scope.users.unshift(data);
            });

            user.getUsers()
                .success(function (response) {

                    if (response.code == 200) {
                        $scope.users = response.data;
                    } else {
                        typing.warning(response.message);
                    }

                })
                .error(function () {

                    typing.error('网络错误');

                });

        }];

    });
