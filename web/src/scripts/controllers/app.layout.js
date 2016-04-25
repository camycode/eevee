/**
 * App 布局控制器
 *
 * 后台管理界面包括边栏,头部交互定义
 *
 * @author 古月(Gue@lehu.io)
 */
define([
    '../directives/sidebar',
    'css!../../css/app.layout'
    ],
    function(){

    return ['$scope', '$state',function($scope, $state) {

      $scope.title = "用户登录";

    }];

});
