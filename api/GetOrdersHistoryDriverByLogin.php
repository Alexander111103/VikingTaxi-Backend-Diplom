<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST["login"];
    $idDriver = ($conn->query("SELECT `drivers`.`id_driver` FROM `users` JOIN `drivers` ON `users`.`id_user` = `drivers`.`user_driver` WHERE `login_user` = '".$login."';"))->fetch_array()["id_driver"];

    $query = "SELECT * FROM `orders` WHERE (`taxiDriver_order` = '".$idDriver."' AND (`status_order` = 'end' OR `status_order` = 'canseled')) ORDER BY `id_order` DESC;";

    $res = $conn->query($query);

    $value = array();

    foreach($res as $one)
    {
        array_push($value, $one);
    }

    $json['orders'] = $value;

    print(json_encode($json));
}
?>