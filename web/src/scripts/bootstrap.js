
require.config({

    baseUrl: "scripts",

    // 模块路径定义　　　　
    paths: {
        'jquery': './vendor/jquery/dist/jquery.min',
        'angular': './vendor/angular/angular',
        'angularRoute': './vendor/angular-ui-router/release/angular-ui-router.min',
        'angularAMD': './vendor/angularAMD/angularAMD.min',
        'domReady': './vendor/domReady/domReady',
        'semantic': './vendor/semantic/dist/semantic.min',
        'slimScroll': './vendor/jQuery-slimScroll/jquery.slimscroll.min',
        'navgoco': './vendor/navgoco/src/jquery.navgoco.min',
        'nestable': './vendor/Nestable/jquery.nestable',
        'app': './app',
        'url': './services/url',
        'ajax': './services/ajax',
        'typing': './services/typing'
    },
    
    // 预加载模块
    map: {
        '*': {
            'css': 'vendor/require-css/css.min'
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


