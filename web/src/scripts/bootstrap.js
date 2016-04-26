require.config({

    baseUrl: "scripts",

    paths: {
        'jquery': './vendor/jquery/dist/jquery.min',
        'angular': './vendor/angular/angular',
        'angularRoute': './vendor/angular-ui-router/release/angular-ui-router.min',
        'angularAMD': './vendor/angularAMD/angularAMD.min',
        'text': 'vendor/requirejs-plugins/lib/text',
        'json': 'vendor/requirejs-plugins/src/json',
        'domReady': './vendor/domReady/domReady',
        'semantic': './vendor/semantic/dist/semantic.min',
        'slimScroll': './vendor/jQuery-slimScroll/jquery.slimscroll.min',
        'navgoco': './vendor/navgoco/src/jquery.navgoco.min',
        'nestable': './vendor/Nestable/jquery.nestable',
        'pace': './vendor/PACE/pace.min',
        'app': './app',
        'url': './services/url',
        'ajax': './services/ajax',
        'typing': './services/typing'
    },

    map: {
        '*': {
            'css': 'vendor/require-css/css.min'
        }
    },

    shim: {
        'angularAMD': {
            deps: ['angularRoute']
        },
        'angular': {
            exports: 'angular'
        },
        'angularRoute': {
            deps: ['angular']
        },
        'pace': {
            deps: ['css!./vendor/PACE/themes/blue/pace-theme-minimal']
        }
    },

    urlArgs: "bust=" + (new Date()).getTime()
    
});

define(['pace'],function (pace) {

    pace.start({
        restartOnPushState: true,
        restartOnRequestAfter: true
    });

    require(['app']);
});


