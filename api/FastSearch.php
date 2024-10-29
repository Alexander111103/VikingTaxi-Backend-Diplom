<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idOrder = $_POST['id'];

    $query = "UPDATE `orders` SET `priority_order` = (`priority_order` + 1), `price_order` = (`price_order` + 50) WHERE `id_order` = ".$idOrder.";";
    $res = $conn->query($query);

    $json["result"] = 1;

    print(json_encode($json));
}
?>