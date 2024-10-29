<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $driversInSearch = ($conn->query("SELECT COUNT(*) as 'count' FROM `drivers` WHERE`status_driver` = 'Search';"))->fetch_array()['count'];
    $ordersInSearch = ($conn->query("SELECT COUNT(*) as 'count' FROM `orders` WHERE`status_order` = 'search';"))->fetch_array()['count'];
    
    if($driversInSearch == 0)
    {
        $driversInSearch = 1;
    }

    if($ordersInSearch == 0)
    {
        $coefficient = $driversInSearch;
    }
    else
    {
        $coefficient = $driversInSearch / $ordersInSearch;
    }

    $tarif = ($conn->query("SELECT * FROM `prices` WHERE `lowerСoefficient_price` < '".$coefficient."' ORDER BY `lowerСoefficient_price` DESC LIMIT 1;"))->fetch_array();

    $json["startPrice"] = $tarif["start_price"];
    $json["minPrice"] = $tarif["min_price"];
    $json["perKmPrice"] = $tarif["toKm_price"];
    $json["perMinPrice"] = $tarif["toMin_price"];

    print(json_encode($json));
}
?>