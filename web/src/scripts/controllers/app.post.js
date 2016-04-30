/**
 * Posts 控制器
 */
define([
        'media',
        'css!../../css/app.post'
    ],
    function () {

        return ['$scope', 'media', function ($scope, media) {

            $scope.title = "文章";

            media.config($scope);

            $scope.openMediaModal = function () {
                media.open($scope);
            };

        }];

    });
