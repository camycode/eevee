
require.config({

    baseUrl: "scripts",

    // 模块路径定义　　　　
    paths: {
        'jquery': './bower/jquery/dist/jquery.min',
        'angular': './bower/angular/angular',
        'angularRoute': './bower/angular-ui-router/release/angular-ui-router.min',
        'angularAMD': './bower/angularAMD/angularAMD.min',
        'domReady': './bower/domReady/domReady',
        'semantic': './bower/semantic/dist/semantic.min',
        'slimScroll': './bower/jQuery-slimScroll/jquery.slimscroll.min',
        'navgoco': './bower/navgoco/src/jquery.navgoco.min',
        'nestable': './bower/Nestable/jquery.nestable',
        'app': './app',
        'url': './services/url',
        'ajax': './services/ajax',
        'typing': './services/typing'
    },
    
    // 预加载模块
    map: {
        '*': {
            'css': 'bower/require-css/css.min'
        }
    },
    // 不兼容模块定义
    shim: {
        'angularAMD': {
            deps: ['angular']
        },
        'angular': {
            exports: 'angular'
        },
        'angularRoute': {
            deps: ['angular']
        }
    },

    // 路由参数：防止缓存
    urlArgs: "bust=" + (new Date()).getTime(),

    // 程序启动
    deps: ['app']


});


