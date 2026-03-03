<?php 
    session_start();
    if (isset($_SESSION['user_id']))
    {
        $user_id = $_SESSION['user_id'];
        $mysql = new mysqli('localhost', 'root', '', 'reg');
        $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$user_id'");
        $user = $result->fetch_assoc();
        $mysql->close();
    }
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $id = $user['id'];
        $mysql = new mysqli('localhost', 'root', '', 'reg');
        //$mysql->query("UPDATE `users` SET (`name`, `phone`, `email`, `password`) VALUES ('$name', '$phone', '$email', '$password') WHERE `id` = '$id'");
        $mysql->query("UPDATE `users` SET `name` = '$name', `phone` = '$phone', `email` = '$email', `password` = '$password' WHERE `id` = '$id'");
        $mysql->close();
        session_start();
        if (isset($_SESSION['user_id']))
        {
            $user_id = $_SESSION['user_id'];
            $mysql = new mysqli('localhost', 'root', '', 'reg');
            $result = $mysql->query("SELECT * FROM `users` WHERE `id` = '$user_id'");
            $user = $result->fetch_assoc();
            $mysql->close();
        }
        echo "Данные изменены";
    } 
?>
<!DOCTYPE html>
<html>
    <head>
    
    </head>
    <body>
        <label>Ваш аккаунт</label><br/><br/>
        <form name="reg" action=" " method="post">
            <label>Имя:</label><?php echo $user['name']; ?>
            <br>
            <input name="name" placeholder="Введите новое имя"/>
            <br>
            <label>Номер телефона:</label><?php echo $user['phone']; ?>
            <br>
            <input name="phone" placeholder="Введите новый номер телефона"/>
            <br>
            <label>Адрес электронной почты:</label><?php echo $user['email']; ?>
            <br>
            <input name="email" placeholder="Введите новый адрес электронной почты"/>
            <br>
            <label>Пароль:</label><?php echo $user['password']; ?>
            <br>
            <input name="password" placeholder="Введите новый пароль"/>
            <br><br>
            <button class="g-recaptcha" data-sitekey="6LcAfX0sAAAAAHU01wIDNgyR1_BHNFcR-7VjDs0d" data-callback='onSubmit' data-action='submit' type="submit">Изменить данные</button>
        </form>
    </body>
</html>