<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $loginDriver = $_POST['login'];

    $query = "SELECT `orders`.`id_order` FROM `users` JOIN `drivers` ON `users`.`id_user` = `drivers`.`user_driver` JOIN `orders` ON `orders`.`taxiDriver_order` = `drivers`.`id_driver` WHERE `users`.`login_user` = '".$loginDriver."' AND (`orders`.`status_order` = 'waitingDriver' OR `orders`.`status_order` = 'waitingUser' OR `orders`.`status_order` = 'drive') ORDER BY `orders`.`id_order` DESC LIMIT 1;";
    $res = $conn->query($query)->fetch_array();

    $json['result'] = $res['id_order'];

    print(json_encode($json));
}
?>