<form method="post" action="register_new.php">

    <div class="formblock">
        <h2>注册流程</h2>

        <p><label for="email">邮箱地址</label><br/>
            <input type="email" name="email" id="email"
                   size="30" maxlength="100" required /></p>

        <p><label for="username">首选用户名 <br>（最多16个字符）：</label><br/>
            <input type="text" name="username" id="username"
                   size="16" maxlength="16" required /></p>

        <p><label for="password">密码懂不？ <br>（6到16个字符之间）：</label><br/>
            <input type="password" name="password" id="password"
                   size="16" maxlength="16" required /></p>

        <p><label for="password2">确认密码懂不？</label><br/>
            <input type="password" name="password2" id="password2"
                   size="16" maxlength="16" required /></p>


        <button type="submit">确认注册</button>

    </div>

</form>
