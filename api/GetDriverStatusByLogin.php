<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];

    $query = "SELECT `drivers`.`status_driver` FROM `users` JOIN `drivers` ON `users`.`id_user` = `drivers`.`user_driver` WHERE `users`.`login_user` = '".$login."';";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["status_driver"];


    print(json_encode($json));
}
?>