<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>M-finder - Login WebIM - 登录</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">
    <link href="favicon.ico" type="image/vnd.microsoft.icon" rel="shortcut icon"/>
    <link href="static/css/font-awesome.min.css" rel="stylesheet">
    <link href="static/css/bootstrap.min.css" rel="stylesheet">
    <link href="static/css/templatemo-style.css" rel="stylesheet">
    <script src="static/layui/layui.js" charset="utf-8"></script>
</head>
<body class="light-gray-bg">
<div class="templatemo-content-widget templatemo-login-widget white-bg tp-8">
    <header class="text-center">
        <div class="square"></div>
        <h1>M-finder WebIM</h1>
    </header>
    <form action="index.html" class="templatemo-login-form">
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-user fa-fw"></i></div>
                <input type="text" id="name" class="form-control" placeholder="请输入登录名称">
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-addon"><i class="fa fa-key fa-fw"></i></div>
                <input type="password" id="pwd" class="form-control" placeholder="******">
            </div>
        </div>

        <div class="form-group">
            <button type="button" class="templatemo-blue-button width-100 login_btn">Login</button>
        </div>
    </form>
</div>
<div class="templatemo-content-widget templatemo-login-widget templatemo-register-widget white-bg">
    <p>Powered by <strong><a href="http://www.m-finder.com" class="blue-text">M-finder</a></strong></p>
</div>
<script>
    layui.use(['layer', 'form'], function () {
        var layer = layui.layer
            , form = layui.form
            , $ = layui.jquery

        $(function () {
            document.onkeyup = function (e) {
                var ev = document.all ? window.event : e;
                if (ev.keyCode === 13) {
                    $('.login_btn').click();
                }
            };
        });

        $('.login_btn').click(function () {
            var name = $('#name').val();
            var pwd = $('#pwd').val();
            if (name == '' || $.trim(name).length == 0) {
                layer.tips('请输入登录名称', '#name', {tips: [3, '#3595cc'], anim: 4});
                return false;
            }
            if (pwd == '' || $.trim(pwd).length == 0) {
                layer.tips('请输入登录密码', '#pwd', {tips: [3, '#3595cc'], anim: 4});
                return false;
            }

            $.ajax({
                type: "POST",
                url: "class/doAction.php?action=login",
                data: {name: name, pwd: pwd},
                dataType: "json",
                beforeSend: function () {
                    layer.load(0, {shade: 0.1});
                },
                success: function (res) {
                    layer.closeAll('loading');
                    if (res.status == 'y') {
                        layer.msg(res.info, {icon: 1});
                        setTimeout(window.location.href = 'index.php', 3000);
                    } else {
                        layer.alert(res.info, {icon: 2});
                    }
                },
                error: function (e, code) {
                    layer.alert('请求异常:' + code, {icon: 2});
					layer.closeAll('loading');
                    console.log(e)
                }
            })
        });
    });
</script>
</body>
</html>

