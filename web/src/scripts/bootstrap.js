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
        'layer': './vendor/layer/src/layer',
        'pace': './vendor/PACE/pace.min',
        'toastr': './vendor/toastr/toastr.min',
        'app': './app',
        'user': './models/user',
        'role': './models/role',
        'url': './services/url',
        'ajax': './services/ajax',
        'typing': './services/typing',
        'storage': './services/storage',
        'role.editor': './directives/role.editor',
        'user.editor': './directives/user.editor'
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
        },
        'layer': {
            deps: ['css!./vendor/layer/skin/layer'],
            exports: 'layer'
        },
        'toastr': {
            deps: ['jquery', 'css!./vendor/toastr/toastr.min']
        }
    },

    urlArgs: "bust=" + (new Date()).getTime()

});

define(['pace'], function (pace) {

    pace.start({
        restartOnPushState: true,
        restartOnRequestAfter: true
    });

    require(['app']);
});


