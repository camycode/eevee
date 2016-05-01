define([
        'typing',
        '../models/user',
        'css!../../css/app.user'
    ],
    function () {

        return ['$scope', 'typing', 'user', function ($scope, typing, user) {

            $scope.title = "用户管理";

            $scope.users = [];

            user.setUserEditor($scope);

            user.setUserDetail($scope);

            $scope.openUserEditor = function () {

                user.openUserEditor();

            };


            $(document).unbind('eevee.post.user').bind('eevee.post.user', function (e, data) {
                $scope.users.unshift(data);
            });

            $scope.openUserDetailModal = function (user_id) {
                user.openUserDetail(user_id);
            };

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
