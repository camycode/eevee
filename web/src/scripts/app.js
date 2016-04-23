define(['angularAMD', 'angularRoute', 'jquery'], function (angularAMD) {

    var app = angular.module("eevee", ['ui.router']);

    app.config(function ($stateProvider, $urlRouterProvider, $locationProvider, $uiViewScrollProvider) {

        //用于改变state时跳至顶部
        $uiViewScrollProvider.useAnchorScroll();

        // 默认进入先重定向
        $urlRouterProvider.otherwise('app');

        $stateProvider
            .state('login', angularAMD.route({
                url: '/login',
                templateUrl: 'views/login.html',
                controllerUrl: 'controllers/login'
            }));

        $stateProvider
            .state('app', angularAMD.route({
                url: '/app',
                templateUrl: 'views/app.html',
                controllerUrl: 'controllers/app.layout'
            }))
            // posts 内容
            .state('app.post', angularAMD.route({
                url: '/post',
                templateUrl: 'views/app.post.html',
                controllerUrl: 'controllers/app.post'
            }))
            // terms 分类栏目
            .state('app.term', angularAMD.route({
                url: '/term',
                templateUrl: 'views/app.term.html',
                controllerUrl: 'controllers/app.term'
            }))
            // users 用户
            .state('app.user', angularAMD.route({
                url: '/user',
                templateUrl: 'views/app.user.html',
                controllerUrl: 'controllers/app.user'
            }))
            // meidas 媒体
            .state('app.media', angularAMD.route({
                url: '/media',
                templateUrl: 'views/app.media.html'
            }))
            // roles 角色
            .state('app.role', angularAMD.route({
                url: '/role',
                templateUrl: 'views/app.role.html',
                controllerUrl: 'controllers/app.role'
            }))
            // config 网站设置
            .state('app.configs_site', angularAMD.route({
                url: '/configs/site',
                templateUrl: 'views/configs/site.html',
                // controller: 'roles',
                // controllerUrl: 'controllers/roles'
            }))
            // config 邮箱设置
            .state('app.configs_email', angularAMD.route({
                url: '/configs/email',
                templateUrl: 'views/configs/email.html',
                // controller: 'roles',
                // controllerUrl: 'controllers/roles'
            }))
            // config 多媒体设置
            .state('app.configs_media', angularAMD.route({
                url: '/configs/media',
                templateUrl: 'views/configs/media.html',
                // controller: 'roles',
                // controllerUrl: 'controllers/roles'
            }));


    });

    return angularAMD.bootstrap(app);

});
