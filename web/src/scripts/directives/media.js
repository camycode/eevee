/**
 * 媒体管理指令
 */
define(['app'], function (app) {
    app.directive('media', function ($http, $compile) {
        return {
            restrict: 'A',
            replace: true,
            scope: {},
            templateUrl: 'views/medias/medias.html',
            controller: ['$scope', function ($scope) {
                $scope.title = "编辑用户";
                $scope.closePostEditor = function () {
                    $("#user-editor").addClass('animated slideOutRight');
                };
            }]
        };
    });
})
