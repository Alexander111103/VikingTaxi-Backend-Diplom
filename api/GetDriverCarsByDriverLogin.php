<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];

    $query = "SELECT `cars`.`id_car`, `cars`.`owner_car`, `cars`.`brand_car`, `cars`.`mark_car`, `cars`.`color_car`, `cars`.`numer_car`, `cars`.`rate_car`, `cars`.`isChildSeet_car`, `cars`.`img_car` FROM `users` JOIN `drivers` ON `users`.`id_user` = `drivers`.`user_driver` JOIN `cars` ON `drivers`.`id_driver` = `cars`.`owner_car` WHERE `users`.`login_user` = '".$login."';";
    $res = $conn->query($query);

    $value = array();

    foreach($res as $auto)
    {
        array_push($value, $auto);
    }

    $json['cars'] = $value;

    print(json_encode($json));
}
?>