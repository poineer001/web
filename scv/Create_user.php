<?php

require_once('container.php');

function register($username, $email, $password) {
//用db注册新人（db 数据库的意思）
//返回true或错误消息

    //连接到db
    $conn = db_connect();

     //检查用户名是否唯一
    $result = $conn->query("select * from user where username='".$username."'");
    if (!$result) {
        throw new Exception('无法执行查询');
    }

    if ($result->num_rows>0) {
        throw new Exception('用户名被采用 - 返回并选择另一个。');
    }

    //如果确定，请输入到db
    $result = $conn->query("INSERT INTO user (username, password,email)
VALUES('".$username."', sha1('".$password."'), '".$email."')");

    if (!$result) {
        throw new Exception('无法在数据库中注册 - 请稍后再试。\'');
    }

    return true;
}

function login($username, $password) {
//用db检查用户名和密码
//如果是，返回true
//否则抛出异常

    //如果确定，请输入数据库

    $conn = db_connect();
    
    //检查用户名是否唯一
        $result = $conn->query("select * from user
                         where username='".$username."'
                         and password = sha1('".$password."')");
    if (!$result) {
        throw new Exception('你无法登陆呢');
    }

    if ($result->num_rows>0) {
        return true;
    } else {
        throw new Exception('你无法登陆呢');
    }
}

function check_valid_user() {
//看看是否有人登录并通知他们，如果没有
    if (isset($_SESSION['valid_user']))  {
        echo "欢迎您 ".$_SESSION['valid_user'].".<br>";
    } else {
        //他们没有登录
        do_html_header('Problem:');
        echo 'You are not logged in.<br>';
        do_html_url('login.php', 'Login');
        do_html_footer();
        exit;
    }
}

function change_password($username, $old_password, $new_password) {
//将username / old_password的密码更改为new_password
//返回true或false

    //如果旧密码是对的
     //将密码更改为new_password并返回true
     //抛出异常
    login($username, $old_password);
    $conn = db_connect();
    $result = $conn->query("update user
                           set password = sha1('".$new_password."')
                          where username = '".$username."'");
    if (!$result) {
        throw new Exception('Password could not be changed.');
    } else {
        return true;  // changed successfully
    }
}

function get_random_word($min_length, $max_length) {
//从字典中抓取两个长度之间的随机单词
//并返回

    //生成一个随机单词
    $word = '';
    //记得更改此路径以适合您的系统
    $dictionary = '/usr/dict/words';  // ispell字典
    $fp = @fopen($dictionary, 'r');
    if(!$fp) {
        return false;
    }
    $size = filesize($dictionary);

    //去字典中的随机位置
    $rand_location = rand(0, $size);
    fseek($fp, $rand_location);

    //在文件中获取正确长度的下一个完整单词
    while ((strlen($word) < $min_length) || (strlen($word)>$max_length) || (strstr($word, "'"))) {
        if (feof($fp)) {
            fseek($fp, 0);        //如果结束，请开始
        }
        $word = fgets($fp, 80);  //跳过第一个单词，因为它可能是部分的
        $word = fgets($fp, 80);  //潜在的密码
    }
    $word = trim($word); //从fgets中修剪尾随\ n
    return $word;
}

function reset_password($username) {
//将username的密码设置为随机值
//返回新密码或失败时返回false
    //得到一个随机词典单词b / w 6和13个字符的长度
    $new_password = get_random_word(6, 13);

    if($new_password == false) {
        //提供默认密码
        $new_password = "changeMe!";
    }

    //在0到999之间添加一个数字
      //使它成为稍微好一点的密码
    $rand_number = rand(0, 999);
    $new_password .= $rand_number;

    //在数据库中将用户密码设置为此密码或返回false
    $conn = db_connect();
    $result = $conn->query("update user
                          set password = sha1('".$new_password."')
                          where username = '".$username."'");
    if (!$result) {
        throw new Exception('Could not change password.');  // not changed
    } else {
        return $new_password; //成功更改
    }
}

function notify_password($username, $password) {
//通知用户他们的密码已被更改

    $conn = db_connect();
    $result = $conn->query("select email from user
                            where username='".$username."'");
    if (!$result) {
        throw new Exception('找不到电子邮件地址。');
    } else if ($result->num_rows == 0) {
        throw new Exception('找不到电子邮件地址。');
        //用户名不在db中
    } else {
        $row = $result->fetch_object();
        $email = $row->email;
        $from = "From: support@55 \r\n";
        $mesg = "您的密码已更改为".$password."\r\n"
            ."Please change it next time you log in.\r\n";

        if (mail($email, '登录信息', $mesg, $from)) {
            return true;
        } else {
            throw new Exception('无法发送电子邮件.');
        }
    }
}

?>
