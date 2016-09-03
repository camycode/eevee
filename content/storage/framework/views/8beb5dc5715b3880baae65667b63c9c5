<!DOCTYPE html>
<html lang="zh-CN">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>EEVEE 后台登录</title>

    <link rel="stylesheet" href="/content/web/src/scripts/vendor/semantic/dist/semantic.min.css">
    <link rel="stylesheet" href="/content/web/src/css/login.css">
    <?php do_action('load_login_styles'); ?>
</head>

<body>

<div class="wrapper">

    <div id="page-login">


        <div class="mask"></div>

        <div class="mask-cover"></div>

        <div id="wrapper" class="ui middle aligned center aligned grid">

            <div class="column">

                <h2 class="ui teal image header">
                    <!--<img src="images/logo.png" class="image">-->
                    <div class="content">
                        EEVEE
                    </div>
                </h2>

                <form class="ui large form">
                    <div class="ui stacked segment">
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="user icon"></i>
                                <input id="account-input" type="text" name="text" placeholder="用户名">
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui left icon input">
                                <i class="lock icon"></i>
                                <input id="password-input" type="password" name="password" placeholder="密码">
                            </div>
                        </div>
                        <!--<div class="ui fluid large teal submit button" ng-click="login()">登录</div>-->
                    </div>

                    <div class="ui error message"></div>

                </form>

                <div id="login-btn" class="ui message">
                    <a href="#">登录</a>
                </div>

            </div>

        </div>

    </div>


</div>

</body>
<script src="/content/web/src/scripts/vendor/jquery/dist/jquery.min.js"></script>
<script>

    $(function () {

        $('#login-btn').click(function () {

            var $accountInput = $('#account-input');
            var $passwordInput = $('#password-input');

            var account = $accountInput.val();
            var password = $passwordInput.val();

            $.ajax({
                url: "/api/login",
                method: 'post',
                dataType: 'json',
                contentType: 'application/json',
                data: JSON.stringify({
                    'username': account,
                    'password': password
                }),
                headers: {
                    "X-App-ID": "backend",
                    "X-App-Version": "1.0.0"
                },
                success: function (res) {

                    if (res.code == 200) {

                        location.href = '/backend/core';
                    }else{

                        alert(res.message);
                    }
                },
                error: function () {

                    alert('网络错误');
                }
            });


        });

    });

</script>
<?php do_action('load_login_scripts'); ?>

</html>


