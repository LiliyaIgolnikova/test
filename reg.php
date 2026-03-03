<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST")
    {
        $name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $password_1 = $_POST['password_1'];
        $password_2 = $_POST['password_2'];
        $mysql = new mysqli('localhost', 'root', '', 'reg');
        $result = $mysql->query("SELECT * FROM `users` WHERE `phone` = '$phone'");
        $checkUser = $result->fetch_assoc();
        if ($checkUser > 0)
        {
            echo 'Этот номер телефона уже используется';
            $mysql->close();
            exit();
        }
        else
        {
            $result = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
            $checkUser = $result->fetch_assoc();
            if ($checkUser > 0)
            {
                echo 'Этот адрес электронной почты уже используется';
                $mysql->close();
                exit();
            }
            else
            {
                if ($password_1 == $password_2)
                {
                    $password = $password_1;
                    $mysql->query("INSERT INTO users (name, phone, email, password) VALUES ('$name', '$phone', '$email', '$password')"); 
                    $mysql->close();
                    header('Location: /account.php');
                }
                else
                {
                    echo "Пароли не совпадают";
                    $mysql->close();
                    exit();
                }
            }
        }
    } 
?>
<!DOCTYPE html>
<html>
    <head>      

    </head>
    <body>
        <label>Форма регистрации</label><br/>
        <form name="reg" action=" " method="post"><br/>
            <input type="text" name="name" placeholder="Введите имя"/><br/>
            <input type="text" name="phone" placeholder="Введите номер телефона"/><br/>
            <input type="email" name="email" placeholder="Введите адрес электронной почты"/><br/>
            <input type="text" name="password_1" placeholder="Введите пароль"/><br/>
            <input type="text" name="password_2" placeholder="Повторите пароль"/><br/>
            <button class="g-recaptcha" data-sitekey="6LcAfX0sAAAAAHU01wIDNgyR1_BHNFcR-7VjDs0d" data-callback='onSubmit' data-action='submit' type="submit">Зарегистрироваться</button>
        </form>
    </body>
</html>