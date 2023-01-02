<?php
if (isset($_COOKIE['sdc'])) {
    unset($_COOKIE['sdc']);
    setcookie('sdc', null, -1, '/');
}
session_start();
?>
<html>

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway');

        body {
            margin: 0;
            padding: 0;
            font-family: 'Raleway', sans-serif;
            color: #000;
            background: url('media/images/bg.jpg') no-repeat;
            background-color: #0b62a4;
            background-size: auto 110%;
            background-position: center;
        }

        #container-logo {
            background-image: url('media/images/logo.png');
            background-position: center;
            background-repeat: no-repeat;
            background-size: 100%;
            position: relative;
            top: -5%;
            margin: auto;
            padding: 0 15px;
            max-width: 280px;
            height: 285px;
            text-align: center;
        }

        #container-login {
            background-color: #f5f5f5;
            position: relative;
            top: -78px;
            margin: auto;
            width: 342px;
            height: 285px;
            border-radius: 0.55em;
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        #container-msg {
            background-color: #f5f5f5;
            position: relative;
            top: -50px;
            margin: auto;
            width: 342px;
            height: 45px;
            border-radius: 0.55em;
            box-shadow: 0 3px 10px 0 rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        #title {
            position: relative;
            background-color: #dcdcdc;
            width: 100%;
            padding: 20px 0px;
            border-radius: 0.35em;
            font-size: 22px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .lock {
            position: relative;
            top: 2px;
        }

        .input {
            margin: auto;
            width: 240px;
            border-radius: 4px;
            border: 1px #b5b3b3 solid;
            background-color: #ffffff;
            padding: 8px 0px;
            margin-top: 15px;
        }

        .input-addon {
            float: left;
            background-color: #fff;
            padding: 4px 8px;
            border-right: 1px solid rgba(255, 255, 255, 0.05);
        }

        input[type=text] {
            color: #949494;
            margin: 0;
            background-color: #fff;
            border: 1px solid #fff;
            padding: 6px 0px;
            border-radius: 3px;
        }

        input[type=text]:focus {
            border: 1px solid #eee;
        }

        input[type=password] {
            color: #949494;
            margin: 0;
            background-color: #fff;
            border: 1px solid #fff;
            padding: 6px 0px;
            border-radius: 3px;
        }

        input[type=password]:focus {
            border: 1px solid #eee;
        }

        *:focus {
            outline: none;
        }

        input[type=submit] {
            padding: 6px 25px;
            background: #db7216;
            color: #FFF;
            font-weight: bold;
            margin: 25px;
            border: 0 none;
            cursor: pointer;
            border-radius: 3px;
        }

        .clearfix {
            clear: both;
        }

        .alert {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            position: relative;
            padding: .75rem 1.25rem;
            margin-bottom: 1rem;
            border: 1px solid transparent;
            border-radius: .25rem;
        }

        .close {
            display: none;
        }
    </style>
</head>

<body>
    <div id="container-logo">
        <div id="logo"></div>
    </div>
    <div id="container-login">
        <div id="title">
            <i class="material-icons lock">lock</i> Login
        </div>

        <form method="post" action="usuario/login" novalidate="1">
            <div class="input">
                <div class="input-addon">
                    <i class="material-icons">face</i>
                </div>
                <input id="username" placeholder="Username" name="username" type="text" required class="validate" autocomplete="off">
            </div>

            <div class="clearfix"></div>

            <div class="input">
                <div class="input-addon">
                    <i class="material-icons">vpn_key</i>
                </div>
                <input id="password" placeholder="Password" type="password" name="password" required class="validate" autocomplete="off">
            </div>


            <input type="submit" value="Log In" />
        </form>
    </div>
    <?php if (isset($_SESSION['msg'])) : ?>
        <div id="container-msg">
            <?php $output = array();
            if (!empty($_SESSION['msg'])) {
                foreach ($_SESSION['msg'] as $key => $value) {
                    $output  = "<div class=\"alert alert-{$key}\">";
                    $output .= "<a href=\"#\" class=\"close\" data-dismiss=\"alert\">&times;</a>";
                    $output .= $value;
                    $output .= "</div>";
                }
                unset($_SESSION['msg']);
                echo $output;
            }
            ?>
        <?php endif; ?>
        </div>
</body>

</html>