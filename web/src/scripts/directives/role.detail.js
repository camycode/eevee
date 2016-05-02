/**
 * user.detail directive
 */
define(
    [
        'app',
        'css!../css/directives/user.detail'
    ],
    function (app) {

        app.directive('user.detail', function () {
            return {
                restrict: 'A',
                replace: true,
                scope: {},
                templateUrl: 'views/directives/user.detail.html',
                controller: ['$scope', function ($scope) {
                    var closeUserEditor = function () {

                        $("#directive-user-detail").addClass('animated slideOutRight');
                    };

                    $scope.closePostEditor = function () {

                        closeUserEditor();

                    };
                }]
            };
        });

    })
  
