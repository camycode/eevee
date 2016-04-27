/**
 * App 布局控制器
 *
 * 后台管理界面包括边栏,头部交互定义
 *
 * @author 古月(Gue@lehu.io)
 */
define([
        'jquery',
        'navgoco',
        'semantic',
        'slimScroll',
        '../directives/sidebar',
        'css!../../css/app.layout'
    ],
    function ($) {

        return ['$scope', '$state', function ($scope, $state) {

            // 垂直导航栏

            $('#eevee-sidebar .menu').navgoco({
                openClass: 'active',
                accordion: true,
                slide: {
                    duration: 200,
                    easing: 'swing'
                },
                onClickAfter: function (e, submenu) {
                    $('#eevee-sidebar .menu .item').removeClass('active');
                    $(e.target).parents('.item').addClass('active');
                }
            });


            // 导航栏滚动体

            // $('#eevee-sidebar .menu').slimScroll({
            //     height: '100%'
            // });

            // 配置头部导航菜单

            $('.ui.selection.dropdown').dropdown();


            $('.ui.menu .ui.dropdown').dropdown({
                on: 'hover'
            });


        }];

    });
