/**
 * post.editor 指令
 */
define(['app', 'jquery'], function (App) {
    App.directive('post.editor', function () {
        return {
            restrict: 'A',
            replace: true,
            templateUrl: 'views/directives/post.editor.html',
            controller: ['$scope', function ($scope) {

                var showPostEditor = function () {
                    $('#directive-post-editor').hide().removeClass('animated slideOutRight').addClass('animated slideInRight').show();

                };

                var hidePostEditor = function () {
                    $('#directive-post-editor').addClass('animated slideOutRight');
                };

                $scope.hidePostEditor = function () {
                    hidePostEditor();
                };

                $scope.$on('post.editor.show', function (e, data) {
                    showPostEditor();
                });

                $scope.$on('post.editor.hide', function () {
                    hidePostEditor();
                });
            }]
        };
    });
});
