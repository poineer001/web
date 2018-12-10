<?php

require_once('container.php');
session_start();

//创建短变量名称
if (!isset($_POST['username']))  {
    //如果不是isset  - >设置为虚拟值
    $_POST['username'] = " ";
}
$username = $_POST['username'];
if (!isset($_POST['password']))  {
    //如果不是isset  - >设置为虚拟值
    $_POST['password'] = " ";
}
$password = $_POST['password'];

if ($username && $password) {
//他们刚尝试登录
    try  {
        login($username, $password);
        //如果他们在数据库中注册用户ID
        $_SESSION['valid_user'] = $username;
    }
    catch(Exception $e)  {
        //登录失败
        do_html_header('提示:');
        echo '你无法登录。<br>
           您必须登录才能查看此页面。';
        do_html_url('login.php', '登陆');
        do_html_footer();
        exit;
    }
}

do_html_header('主页');
check_valid_user();
//获取此用户已保存的
//
//if ($url_array = get_user_urls($_SESSION['valid_user'])) {
//   display_user_urls($url_array);
//}

//给出选项菜单
display_user_menu();
do_html_footer();
echo "sdaasf";
?>
