<?php
session_start();
$db_host = 'localhost';
$db_name = 'ruins';
$db_user = 'limit';
$db_pwd = 'god24';

if (isset($_POST['userid']) && isset($_POST['password']))
{
//如果用户刚刚尝试登录
    $userid = $_POST['userid'];
    $password = $_POST['password'];

//面向对象方式
    $db_conn = new mysqli($db_host,$db_user,$db_pwd,$db_name);

    if (mysqli_connect_errno()) {
        echo '连接数据库失败：'.mysqli_connect_error();
        exit();
    }

    $query = "select * from authorized_users where 
            name='".$userid."' and 
            password='".$password."'";
//某个sb教科书居然教学加密也不说；
    $result = $db_conn->query($query);
    if ($result->num_rows)
    {
        //如果他们在数据库中注册用户ID
        $_SESSION['valid_user'] = $userid;
    }
    $db_conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>主页面</title>
    <style type="text/css">
        fieldset {
            width: 50%;
            border: 2px solid #ff0000;
        }
        legend {
            font-weight: bold;
            font-size: 125%;
        }
        label {
            width: 125px;
            float: left;
            text-align: left;
            font-weight: bold;
        }
        input {
            border: 1px solid #000;
            padding: 3px;
        }
        button {
            margin-top: 12px;
        }
    </style>
</head>
<body>
<h1>登陆界面</h1>
<a href="register_new.php">还没注册?</a>
<?php
if (isset($_SESSION['valid_user']))
{
    echo '<p>You are logged in as: '.$_SESSION['valid_user'].' <br />';
    echo '<a href="logout.php">Log out</a></p>';
}
else
{
    if (isset($userid))
    {
//如果他们尝试过但未能登录
        echo '<p>Could not log you in.</p>';
    }
    else
    {
        //他们还没有尝试登录或已注销
        echo '<p>You are not logged in.</p>';
    }

    //提供登录表格
    echo '<form action="hello.php" method="post">';
    echo '<fieldset>';
    echo '<legend></legend>';
    echo '<p><label for="userid">用户名:</label>';
    echo '<input type="text" name="userid" id="userid" size="30"/></p>';
    echo '<p><label for="password">密码:</label>';
    echo '<input type="password" name="password" id="password" size="30"/></p>';
    echo '</fieldset>';
    echo '<button type="submit" name="login">登陆</button>';
    echo '</form>';

}
?>
</body>
</html>