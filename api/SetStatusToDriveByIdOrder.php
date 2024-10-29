<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idOrder = $_POST['id'];

    $query = "UPDATE `orders` SET `status_order` = 'drive' WHERE `id_order` = ".$idOrder.";";
    $res = $conn->query($query);

    $json["result"] = '1';

    print(json_encode($json));
}
?>