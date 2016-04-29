<?php

/*

Jappix - An open social platform
This is the Jappix Desktop PHP/HTML code

-------------------------------------------------

License: AGPL
Author: Valérian Saliou, Maranda

*/

// Someone is trying to hack us?
if(!defined('JAPPIX_BASE')) {
    exit;
}

?>
<!DOCTYPE html>
<?php htmlTag($locale); ?>

<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />

    <?php
        // Enable compatibility mode for IE 10
        if (isset($_SERVER['HTTP_USER_AGENT']) && preg_match("/MSIE 10\.0/", $_SERVER['HTTP_USER_AGENT'])) {
            echo '<meta http-equiv="X-UA-Compatible" content="IE=9" />';
            echo "\n\t";
        }
    ?>

    <title><?php echo htmlspecialchars(SERVICE_NAME); ?> &bull; <?php echo htmlspecialchars(SERVICE_DESC); ?></title>
    <link rel="shortcut icon" href="./favicon.ico" />

    <?php echoGetFiles($hash, '', 'css', 'desktop.xml', ''); echo "\n"; ?>
    <!--[if lt IE 9]><?php echoGetFiles($hash, '', 'css', '', 'ie.css'); ?><![endif]-->

    <?php echoGetFiles($hash, $locale, 'js', 'desktop.xml', ''); echo "\n";

    if(anonymousMode()) {
        echo "\n\t";
        echoGetFiles($hash, '', 'css', 'anonymous.xml', '');
        echo "\n\t";
        echoGetFiles($hash, $locale, 'js', 'anonymous.xml', '');
        echo "\n";
    }

    if(httpAuthEnabled()) {
        echo "\n\t";
        echoGetFiles($hash, '', 'js', 'httpauth.xml', '');
        echo "\n\t";
        httpAuthentication();
        echo "\n";
    } ?>

    <!--link rel="stylesheet" href="app/stylesheets/mysender.css"-->
</head>

<body class="body-images1">

<?php

// Homepage?
if(!anonymousMode() && !httpAuthEnabled()) { ?>
    <!-- BEGIN HOMEPAGE -->
    <div id="home">
        
        <section>
    <div class="conteiner_logon">
        <div class="logo"><img src="app/images/logo.png" alt=""></div>
        <div class="title">Вход</div>
        <form id='comein'>
            <input type="text" name="" value placeholder="Логин" id='login'>
            <div class="block">
                <input type="password" name="" value placeholder="Пароль" id='pwd'>
                <a href="#" class="forgot_password">Забыли пароль?</a>
            </div>
            <button type="submit" id = "loginer">Войти</button>
        </form>
        <a href="#pop" class="logon">Регистрация</a>
    </div>
</section>
        
    </div>

    <!-- END HOMEPAGE -->
<?php } ?>


<script>
    var a = document.getElementById('loginer');
    a.addEventListener('click',function(){
        
        var login = document.querySelector('#login').value;
        var pwd = document.querySelector("#pwd").value;
        var server = "xmpp.mysender.ru";

        var dog = login.indexOf('@');
        if (dog!=-1){
            server = login.substring(dog+1);
            login = login.substring(0,dog);
        }

        Connection.doLogin(login,server,pwd,"MySender");    
    });
</script>

<!-- BEGIN BOARD -->
<div id="board">
    <noscript class="one-board info visible"><?php _e("JavaScript is missing in your web browser, so that you will not be able to launch Jappix! Please fix this."); ?></noscript>
</div>
<!-- END BOARD -->

<?php include(JAPPIX_BASE.'/server/analytics.php'); ?>

</body>

</html>

<!-- Jappix <?php echo $version; ?> - An open social platform -->
