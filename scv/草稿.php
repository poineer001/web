<?php
limit god24




<?php
 require_once ('Module_databse_connection.php');
 //创建短变量名称
$email=$_POST['email'];
$username=$_POST['username'];
$password=$_POST['password'];
$password2=$_POST['password2'];
    //稍后可能需要启动会话
   //现在开始吧因为它必须在标题之前
session_start();
try   {
    //检查填写的表格

    if (!filled_out($_POST)) {
        throw new Exception('你没有正确填写表格 - 请回去再试一次。');
    }

    //电子邮件地址无效
    if (!valid_email($email)) {
        throw new Exception('这不是一个有效的电子邮件地址。请回去再试一次。');
    }

    //密码不一样
    if (password != password2) {
        throw new Exception('您输入的密码不匹配 - 请返回并重试。');
    }

    //检查密码长度是否正常
    //如果用户名截断，则确定，但密码将获得
    //如果它们太长就会被拒绝
    if ((strlen($password) < 6) || (strlen($password) > 16)) {
        throw new Exception('您的密码必须在6到16个字符之间。请返回并重试。');
    }

    //尝试注册
    //这个函数也可以抛出异常
    register($username, $email, $password);
    //注册会话变量
    $_SESSION['valid_user'] = $username;

    echo "注册会话变量结束";
    do_html_header('注册成功');
    echo '您的注册成功。转到会员页面！';
    do_html_url('Homepage.php', '转到会员页面');

    //结束页面
    do_html_footer();
}
catch (Exception $e) {
    do_html_header('Problem:');
    echo $e->getMessage();
    do_html_footer();
    exit;
}
?>


//稍后可能需要启动会话
//现在开始吧因为它必须在标题之前
session_start();
try   {
//检查填写的表格

if (!filled_out($_POST)) {
throw new Exception('你没有正确填写表格 - 请回去再试一次。');
}

//电子邮件地址无效
if (!valid_email($email)) {
throw new Exception('这不是一个有效的电子邮件地址。请回去再试一次。');
}

//密码不一样
if (password != password2) {
throw new Exception('您输入的密码不匹配 - 请返回并重试。');
}

//检查密码长度是否正常
//如果用户名截断，则确定，但密码将获得
//如果它们太长就会被拒绝
if ((strlen($password) < 6) || (strlen($password) > 16)) {
throw new Exception('您的密码必须在6到16个字符之间。请返回并重试。');
}

//尝试注册
//这个函数也可以抛出异常
register($username, $email, $password);
//注册会话变量
$_SESSION['valid_user'] = $username;

echo "注册会话变量结束";
do_html_header('注册成功');
echo '您的注册成功。转到会员页面！';
do_html_url('personal.php', '转到会员页面');

//结束页面
do_html_footer();
}
catch (Exception $e) {
do_html_header('Problem:');
echo $e->getMessage();
do_html_footer();
exit;
}



//稍后可能需要启动会话
//现在开始吧因为它必须在标题之前
session_start();
try   {
//检查填写的表格

if (!filled_out($_POST)) {
throw new Exception('你没有正确填写表格 - 请回去再试一次。');
}

//电子邮件地址无效
if (!valid_email($email)) {
throw new Exception('这不是一个有效的电子邮件地址。请回去再试一次。');
}

//密码不一样
if (password != password2) {
throw new Exception('您输入的密码不匹配 - 请返回并重试。');
}

//检查密码长度是否正常
//如果用户名截断，则确定，但密码将获得
//如果它们太长就会被拒绝
if ((strlen($password) < 6) || (strlen($password) > 16)) {
throw new Exception('您的密码必须在6到16个字符之间。请返回并重试。');
}

//尝试注册
//这个函数也可以抛出异常
register($username, $email, $password);
//注册会话变量
$_SESSION['valid_user'] = $username;

echo "注册会话变量结束";
do_html_header('注册成功');
echo '您的注册成功。转到会员页面！';
do_html_url('personal.php', '转到会员页面');

//结束页面
do_html_footer();
}
catch (Exception $e) {
do_html_header('Problem:');
echo $e->getMessage();
do_html_footer();
exit;
}

<?php
echo hash('sha256', 'The quick brown fox jumped over the lazy dog.');


echo "-------";
('".$username."',sha1('".$password."'), '".$email."')");
sha256
    ('".$username."',hash(sha256,('".$password."')), '".$email."')");

    ('".$username."',hash('sha256',"$password")'".$email."')";
    
    <?php
$password = '6';
echo "$password";
hash('sha256',"$password");
echo  hash('sha256',"$password");


"INSERT INTO user ".
"(username,password,email) ".
"VALUES ".
"('$username','hash('sha256','$password')','$email')";


query("insert into user values
('\".$username.\"', hash('sha256',".$password.\"'), '".$email."')\");

    hash('sha256','$password');

        query("select * from user
                         where username='".$username."'
and passwd = sha1('".$password."')");
    
    
    <?php

require_once('container.php');
session_start();
$old_user = $_SESSION['valid_user'];

//存储以测试它们是否*已登录

unset($_SESSION['valid_user']);
$result_dest = session_destroy();

//开始输出html
do_html_header('登出');

if (!empty($old_user)) {
    if ($result_dest)  {
  //如果他们已登录并现已注销
        echo ' <br>';
        do_html_url('login.php', 'Login');
    } else {
  //他们已登录且无法注销

        echo '无法让你退出。<br>';
    }
} else {
    //如果他们没有登录但是以某种方式来到这个页面
    echo '你没有登录，所以还没有登出。<br>';
    do_html_url('login.php', '登入');
}

do_html_footer();

?>
