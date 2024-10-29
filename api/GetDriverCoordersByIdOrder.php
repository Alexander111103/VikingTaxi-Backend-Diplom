<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idOrder = $_POST['id'];

    $query = "SELECT `drivers`.`coorders_driver` FROM `orders` JOIN `drivers` ON `orders`.`taxiDriver_order` = `drivers`.`id_driver` WHERE `id_order` = ".$idOrder.";";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["coorders_driver"];

    print(json_encode($json));
}
?>