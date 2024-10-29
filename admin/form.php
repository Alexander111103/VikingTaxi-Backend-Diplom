<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../media/img/logo.png" rel="icon" type="image/x-icon">
    <title>Admin_hub</title>
    <style>
        .center
        {
            width: 100%;
            height: 95vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form
        {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
    </style>
</head>
<body>
<main>
    <div class="center">
        <div>
            <form action="" method="post">
                <input type="text" placeholder="login" name="login" required>
                <input type="password" placeholder="password" name="password" required>
                <input type="submit" value="Войти">
                <?php if(isset($_GET['mes'])){?><p><?php echo $_GET['mes']; ?></p><?php }?>
            </form>
        </div>
    </div>
</main>
</body>
</html>
<?php 

    $conn = new mysqli("localhost", "root", "", "VikingTaxi");
    
    if(isset($_POST["login"]) && isset($_POST["password"]))
    {
        $isAdmin = ($conn->query("SELECT COUNT(*) as 'count' FROM `users` WHERE `login_user` = '".$_POST["login"]."' AND `password_user` = '".$_POST["password"]."' AND `role_user` = 'admin';"))->fetch_array()['count'];
        if($isAdmin == 1)
        {
            setcookie("userLogin", $_POST['login'], time()+60*60, "/");
            setcookie("userPassword", $_POST['password'], time()+60*60, "/");
            header("Location:  /admin/");
        }
        else
        {
            header("Location:  /admin/form.php?mes=Неверны логин или пароль или роль");
        }
    }
?>