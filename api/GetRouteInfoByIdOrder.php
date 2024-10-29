<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $id = $_POST['id'];

    $query = "SELECT `distance_order`, `duration_order`, `durationInTraffic_order`, `startShort_order`, `finishShort_order`, `startLong_order`, `finishLong_order`, `startCoorders_order`, `finishCoorders_order` FROM `orders` WHERE `id_order` = '".$id."';";
    $res = ($conn->query($query))->fetch_array();

    $json["distance"] = $res["distance_order"];
    $json["duration"] = $res["duration_order"];
    $json["durationInTraffic"] = $res["durationInTraffic_order"];
    $json["startShort"] = $res["startShort_order"];
    $json["finishShort"] = $res["finishShort_order"];
    $json["startLong"] = $res["startLong_order"];
    $json["finishLong"] = $res["finishLong_order"];
    $json["startCoorders"] = $res["startCoorders_order"];
    $json["finishCoorders"] = $res["finishCoorders_order"];

    print(json_encode($json));
}
?>