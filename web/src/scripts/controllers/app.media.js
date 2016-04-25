/**
 * Posts 控制器
 */
define([],
    function () {
        return ['$scope', '$state', 'PostEditor', function ($scope, $state, PostEditor) {
            PostEditor.init($scope);
            $scope.title = "文章";
            $scope.openPostEditor = function () {
                PostEditor.open();
            }
        }];
    });
