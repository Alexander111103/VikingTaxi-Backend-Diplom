<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $loginDriver = $_POST['loginDriver'];
    $idOrder = $_POST['idOrder'];

    $idDriver = ($conn->query("SELECT `drivers`.`id_driver` FROM `users` JOIN `drivers` ON `users`.`id_user` = `drivers`.`user_driver` WHERE `users`.`login_user` = '".$loginDriver."';"))->fetch_array()["id_driver"];

    $query = "UPDATE `orders` SET `taxiDriver_order` = '".$idDriver."', `status_order` = 'searched' WHERE `orders`.`id_order` = '".$idOrder."';";
    $res = $conn->query($query);

    $json["result"] = "1";

    print(json_encode($json));
}
?>