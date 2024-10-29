<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];

    $query = "SELECT `cars`.`id_car`, `cars`.`owner_car`, `cars`.`brand_car`, `cars`.`mark_car`, `cars`.`color_car`, `cars`.`numer_car`, `cars`.`rate_car`, `cars`.`isChildSeet_car`, `cars`.`img_car` FROM `users` JOIN `drivers` ON `drivers`.`user_driver` = `users`.`id_user` JOIN `cars` ON `drivers`.`currentCar_driver` = `cars`.`id_car` WHERE `login_user` = '".$login."';";
    $res = ($conn->query($query))->fetch_array();

    $json["id_car"] = $res["id_car"];
    $json["owner_car"] = $res["owner_car"];
    $json["brand_car"] = $res["brand_car"];
    $json["mark_car"] = $res["mark_car"];
    $json["color_car"] = $res["color_car"];
    $json["numer_car"] = $res["numer_car"];
    $json["rate_car"] = $res["rate_car"];
    $json["isChildSeet_car"] = $res["isChildSeet_car"];
    $json["img_car"] = $res["img_car"];

    print(json_encode($json));
}
?>
