/**
 * Posts 控制器
 */
define([
        'ueditor.source',
        'ueditor.lang',
        'media',
        'post',
        'css!../../css/app.post'
    ],
    function (UE) {

        return ['$scope', 'media', 'post', function ($scope, media, post) {
            // window.UEDITOR_HOME_URL = '/src/js/lib/ueditor1_4_3-utf8-php/';

            ueditor = new UE.ui.Editor();
            
            ueditor.render(element[0]);
            

            // media.config($scope);
            //
            // $scope.openMediaModal = function () {
            //     media.open($scope);
            // };
            post.setPostEditor($scope);

            $scope.openPostEditor = function () {
                $scope.$emit('post.editor.show');
            };

        }];

    });
