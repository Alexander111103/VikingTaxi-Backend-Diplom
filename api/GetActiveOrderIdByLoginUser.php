<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];

    $query = "SELECT `orders`.`id_order` FROM `orders` JOIN `users` on `orders`.`user_order` = `users`.`id_user` WHERE `users`.`login_user` = '".$login."' AND `orders`.`status_order` != 'canseled' AND `orders`.`status_order` != 'end' ORDER BY `orders`.`id_order` DESC LIMIT 1;";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["id_order"];

    print(json_encode($json));
}
?>