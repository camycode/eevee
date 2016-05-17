/**
 * App 布局控制器
 *
 * 后台管理界面包括边栏,头部交互定义
 *
 * @author 古月(Gue@lehu.io)
 */
define([
        'navgoco',
        'semantic',
        'slimScroll',
        'user',
        'url',
        '../directives/sidebar',
        'css!../../css/app'
    ],
    function () {

        return ['$scope', '$state', 'user', 'url', function ($scope, $state, user, url) {

            // 检查用户是否登录
            if (!user.isLogin()) {
                url.redirect('/login');
            } else {
                $('#eevee-layout').show();
            }

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


            // 配置头部导航菜单
            $('.ui.selection.dropdown').dropdown();

            
            $('.ui.menu .ui.dropdown').dropdown({
                on: 'click'
            });

            // 用户注销
            $scope.logout = function () {

                user.logout(function () {
                    url.redirect('/login');
                });

            }


        }];

    });
