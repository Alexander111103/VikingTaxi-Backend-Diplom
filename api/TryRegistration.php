<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $lastname= $_POST['lastname'];
    $phone = $_POST['phone'];

    $query = "INSERT INTO `users` (`id_user`, `login_user`, `password_user`, `name_user`, `lastname_user`, `phone_user`, `role_user`) VALUES (NULL, '".$login."', '".$password."', '".$name."', '".$lastname."', '".$phone."', 'user');";
    $res = $conn->query($query);


    $json["result"] = "1";

    print(json_encode($json));
}
?>