/**
 * 媒体管理指令
 */
define(['app'], function (app) {

    app.directive('media', function () {

        return {
            restrict: 'A',
            replace: true,
            scope: {},
            templateUrl: 'views/medias/medias.html',
            controller: ['$scope', function ($scope) {
                $scope.title = "";

            }]
        };

    });
    
})
