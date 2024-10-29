<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idOrder = $_POST['id'];

    $query = "SELECT `cars`.`brand_car`, `cars`.`mark_car`, `cars`.`color_car`, `cars`.`numer_car`, `cars`.`img_car`, `drivers`.`rating_driver`, `drivers`.`drivingExperience_driver`, `users`.`name_user`, `users`.`lastName_user`, `users`.`phone_user` FROM `orders` JOIN `drivers` ON `orders`.`taxiDriver_order` = `drivers`.`id_driver` JOIN `cars` ON `drivers`.`currentCar_driver` = `cars`.`id_car` JOIN `users` ON `drivers`.`user_driver` = `users`.`id_user` WHERE `id_order` = ".$idOrder.";";
    $res = $conn->query($query);
    $res_query = $res->fetch_array();

    $json["brand"] = $res_query["brand_car"];
    $json["mark"] = $res_query["mark_car"];
    $json["color"] = $res_query["color_car"];
    $json["numer"] = $res_query["numer_car"];
    $json["img"] = $res_query["img_car"];
    $json["rating"] = $res_query["rating_driver"];
    $json["experience"] = $res_query["drivingExperience_driver"];
    $json["name"] = $res_query["name_user"];
    $json["lastName"] = $res_query["lastName_user"];
    $json["phone"] = $res_query["phone_user"];

    print(json_encode($json));
}
?>