define(['angularAMD', 'json!../config.json', 'jquery'], function (angularAMD,config) {

    var app = angular.module("eevee", ['ui.router']);

    app.config(function ($stateProvider, $urlRouterProvider, $locationProvider, $uiViewScrollProvider) {

        //用于改变state时跳至顶部
        $uiViewScrollProvider.useAnchorScroll();

        // 默认进入先重定向
        $urlRouterProvider.otherwise('app');

        var routes = config.routes || [];

        // 路由定义
        for (var i in routes) {
            $stateProvider.state(i, angularAMD.route(routes[i]));
        }

    });

    return angularAMD.bootstrap(app);

});
