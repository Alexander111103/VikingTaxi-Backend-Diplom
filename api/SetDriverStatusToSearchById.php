<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idDriver = $_POST['idDriver'];
    $idCar = $_POST['idCar'];
    $coorders = $_POST['coorders'];

    $query = "UPDATE `drivers` SET `status_driver` = 'search', `currentCar_driver` = '".$idCar."', `coorders_driver` = '".$coorders."' WHERE `drivers`.`id_driver` = '".$idDriver."';";
    $res = $conn->query($query);

    $json["result"] = "1";

    print(json_encode($json));
}
?>