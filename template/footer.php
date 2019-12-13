        <td class="right-collum-index">            
            <div class="project-folders-menu">
            <?php if (isset($_SESSION['auth'])) : ?>
                <ul class="project-folders-v">
                    <li<?=$classActive?>><a href="?login=no">Выйти</a></li>
                </ul>
            <? endif; ?>
            <?php if (!isset($_SESSION['auth'])) : ?>
                <ul class="project-folders-v">
                    <li<?=$classActive?>><a href="?login=yes">Авторизация</a></li>
                    <li><a href="#">Регистрация</a></li>
                    <li><a href="#">Забыли пароль?</a></li>
                </ul>
            <? endif; ?>
                <div class="clearfix"></div>
            </div>
            
            <div class="index-auth">
                <?php
                if (isset($_SESSION['PHPSESSID']) && $_SESSION['auth'] && $_SESSION['PHPSESSID'] == $sessid) {
                    echo "Добро пожаловать, {$_SESSION['login']}!";
                } else {
                    if (! empty($_POST)) {
                        if ($auth) {
                            include $_SERVER['DOCUMENT_ROOT'] . "/template/$file";
                        } else {
                            if (isset($notLogin)) {
                                echo $notLogin;
                            } else {
                                include $_SERVER['DOCUMENT_ROOT'] . "/template/$file";
                            }                            
                            include $_SERVER['DOCUMENT_ROOT'] . "/template/form.php";
                        }
                    }
                    if (isset($_GET['login']) && $_GET['login'] == 'yes') {
                        include $_SERVER['DOCUMENT_ROOT'] . "/template/form.php";
                    }
                }           
                ?>                    
            </div>
        </td>
    </tr>
</table>
<div class="clearfix">
    <?php showMenu($arrMenu, 'bottom', SORT_DESC); ?>
</div>

<div class="footer">&copy;&nbsp;<nobr>2019</nobr> Project.</div>

</body>
</html>