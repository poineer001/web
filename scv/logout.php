<?php

require_once('container.php');
session_start();
$old_user = $_SESSION['valid_user'];

//存储以测试它们是否已登录
unset($_SESSION['valid_user']);
$result_dest = session_destroy();

do_html_header('注销');

if (!empty($old_user)) {
    if ($result_dest)  {
        //如果他们已登录并现已注销
        echo '登出。<br>';
        do_html_url('login.php', '登出');
    } else {
        //他们已登录且无法注销
        echo '无法登出。<br>';
    }
} else {
    //如果他们没有登录但是以某种方式来到这个页面
    echo '您尚未登录，因此尚未注销。<br>';
    do_html_url('login.php', 'Login');
}

do_html_footer();

?>