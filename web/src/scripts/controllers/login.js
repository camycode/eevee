/**
 * Posts 控制器
 */
define([
        'user',
        'storage',
        'typing',
        'css!../../css/login'
    ],
    function () {

        return ['$scope', '$state', 'user', 'storage', 'typing', function ($scope, $state, user, storage, typing) {

            $scope.account = null;
            $scope.password = null;


            $scope.login = function () {

                user.login({
                        account: $scope.account,
                        password: $scope.password
                    },
                    function (response) {

                        if (response.code == 200) {

                            $state.go('app.post');

                        } else {

                            typing.tip(response.message, '#account');

                        }

                    });
            };

        }];

    });
