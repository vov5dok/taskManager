<form action="/" method="post">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td class="iat">
                <?php if (isset($_COOKIE['login'])) :?>
                    <p><?=htmlspecialchars($_COOKIE['login'])?>, авторизуйтесь!</p>
                <?php else :?>
                    <label for="login_id">Ваш логин:</label>
                    <input id="login_id" size="30" name="login" value="<?=$_POST['login'] ?? ''?>">
                <?php endif ?>
            </td>
        </tr>
        <tr>
            <td class="iat">
                <label for="password_id">Ваш пароль:</label>
                <input id="password_id" size="30" name="password" type="password" value="<?=$_POST['password'] ?? ''?>">
            </td>
        </tr>
        <tr>
            <td><input type="submit" value="Войти" name="auth"></td>
        </tr>
    </table>
</form>