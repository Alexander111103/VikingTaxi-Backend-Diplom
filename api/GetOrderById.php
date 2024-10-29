<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idOrder = $_POST['id'];

    $query = "SELECT * FROM `orders` WHERE `id_order` = '".$idOrder."';";
    $res = ($conn->query($query))->fetch_array();

    $json["id_order"] = $res["id_order"];
    $json["date_order"] = $res["date_order"];
    $json["timeStart_order"] = $res["timeStart_order"];
    $json["timeFinish_order"] = $res["timeFinish_order"];
    $json["distance_order"] = $res["distance_order"];
    $json["duration_order"] = $res["duration_order"];
    $json["durationInTraffic_order"] = $res["durationInTraffic_order"];
    $json["startShort_order"] = $res["startShort_order"];
    $json["finishShort_order"] = $res["finishShort_order"];
    $json["startLong_order"] = $res["startLong_order"];
    $json["finishLong_order"] = $res["finishLong_order"];
    $json["startCoorders_order"] = $res["startCoorders_order"];
    $json["finishCoorders_order"] = $res["finishCoorders_order"];
    $json["status_order"] = $res["status_order"];
    $json["priority_order"] = $res["priority_order"];
    $json["price_order"] = $res["price_order"];
    $json["rate_order"] = $res["rate_order"];
    $json["paymentType_order"] = $res["paymentType_order"];
    $json["user_order"] = $res["user_order"];
    $json["taxiDriver_order"] = $res["taxiDriver_order"];
    $json["timeInSearch_order"] = $res["timeInSearch_order"];
    $json["timeInWaitDriver_order"] = $res["timeInWaitDriver_order"];
    $json["timeInDrive_order"] = $res["timeInDrive_order"];
    $json["rating_order"] = $res["rating_order"];

    print(json_encode($json));
}
?>