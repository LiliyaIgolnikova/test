<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $login = $_POST['login'];
        $password = $_POST['password'];
        $mysql = new mysqli('localhost', 'root', '', 'reg');
        $result = $mysql->query("SELECT * FROM `users` WHERE `phone` = '$login' || `email` = '$login' AND `password` = '$password'");
        $checkUser = $result->fetch_assoc();
        if ($checkUser > 0)
        {
            $result = $mysql->query("SELECT id FROM `users` WHERE `phone` = '$login' || `email` = '$login' AND `password` = '$password'");
            $user_id = $result->fetch_assoc();
            session_start();
            $_SESSION['user_id'] = $user_id['id'];
            $mysql->close();
            header('Location: /account.php');
        }
        else 
        {
            $mysql->close();
            header('Location: /');
        }       
    }   
?>
<!DOCTYPE html>
<html>
    <head>      
        <script src="https://www.google.com/recaptcha/api.js?render=reCAPTCHA_site_key"></script>
    </head>
    <body>
        <label>Форма авторизации</label><br/>
        <form name="auth" action=" " method="post"><br/>
            <input type="text" name="login" placeholder="Введите номер телефона или адрес электронной почты"/><br/>
            <input type="text" name="password" placeholder="Введите пароль"/><br/>
            <button class="g-recaptcha" data-sitekey="6LcAfX0sAAAAAHU01wIDNgyR1_BHNFcR-7VjDs0d" data-callback='onSubmit' data-action='submit' type="submit">Войти</button>
        </form>
    </body>
</html>