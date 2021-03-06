<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EEVEE 后台管理</title>
    <link rel="stylesheet" href="/content/web/src/scripts/vendor/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="/content/web/src/css/app.css">

    <?php do_action('load_styles'); ?>

</head>

<body>

<div id="eevee-layout" class="page">

    <div id="eevee-header" class="ui menu">
        <div class="item brand">EEVEE</div>
        <a class="item"><i class="sidebar icon"></i></a>
        <div class="right menu">

            <div class="ui dropdown item" tabindex="0">
                <i class="grid layout icon"></i>
                <div id="shortcuts-wrap" class="user panel menu transition hidden" tabindex="-1">
                    <div class="item">一些快捷方式...</div>
                </div>
            </div>

            <div class="ui dropdown item" tabindex="0">
                <i class="mail outline icon"></i>
                <div id="messages-wrap" class="user panel menu transition hidden" tabindex="-1">
                    <div class="item">一些系统消息...</div>
                </div>
            </div>

            <div class="ui dropdown item" tabindex="0">
                <img src="<?php echo array_value($be_access_user, 'avatar'); ?>" alt="" class="ui avatar image">
                <i class="dropdown icon"></i>
                <div class="user panel menu transition hidden" tabindex="-1">
                    <div class="item" ng-click="userInformation()">个人信息</div>
                    <div class="item"><a href="#/app/dashboard">面板</a></div>
                    <div class="divider"></div>
                    <div class="item" ng-click="logout()">退出登录</div>
                </div>
            </div>
        </div>
    </div>

    <aside id="eevee-sidebar" class="sidebar">

        <ul class="ui vertical menu">
            <li class="item">
                <a href="/backend/core?page=post"><i class="edit icon"></i></i>文章</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=term"><i class="block layout icon"></i>分类</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=media"><i class="video play icon"></i>多媒体</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=user"><i class="user icon"></i>用户</a>
            </li>

<!--            <li class="item">-->
<!--                <a href="/backend/core?page=role"><i class="spy icon"></i>角色</a>-->
<!--            </li>-->

            <?php do_action('load_side_menus'); ?>

            <li class="item">
                <a href="/backend/core?page=theme"><i class="paint brush icon"></i>主题</a>
            </li>
            <li class="item">
                <a href="/backend/core?page=plugin"><i class="puzzle icon"></i>插件</a>
            </li>
            <li class="item">
                <a class="" href="#"><i class="setting icon"></i>配置</a>
                <ul>
                    <li class="item"><a href="/backend/core?config=site">网站</a></li>
                    <li class="item"><a href="/backend/core?config=email">邮箱</a></li>
                    <li class="item"><a href="/backend/core?config=media">多媒体</a></li>
                </ul>
            </li>
            <li class="item">
                <a href="#"><i class="area info icon"></i></i>帮助</a>
            </li>

        </ul>

    </aside>

    <section id="eevee-placeholder">

        <div id="eevee-view">

            <?php echo $be_content ?>


            <?php do_action('load_components'); ?>

        </div>

    </section>

</div>

</body>

<script src="/content/web/src/scripts/vendor/jquery/dist/jquery.min.js"></script>
<script src="/content/web/src/scripts/vendor/angular/angular.min.js"></script>
<script src="/content/web/src/scripts/vendor/angular-ui-router/release/angular-ui-router.min.js"></script>
<script src="/content/web/src/scripts/vendor/semantic/dist/semantic.min.js"></script>
<script src="/content/web/src/scripts/vendor/navgoco/src/jquery.navgoco.min.js"></script>
<script src="/content/web/src/scripts/vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="/content/web/src/scripts/vendor/layer/layer.js"></script>
<script src="/content/plugins/core/web/components.js"></script>
<script>
    var eevee = {
        config: {
            app_id: "<?php echo 'backend'; ?>",
            user_token: "<?php echo ''; ?>",
            host: 'http://dev.eevee.io'
        }
    };
</script>
<?php do_action('load_scripts'); ?>

</html>


