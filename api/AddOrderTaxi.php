<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");
    
    $date = date("d.m.Y");
    $time = date("H:i");
    $distance = $_POST['distance'];
    $duration = $_POST['duration'];
    $durationInTraffic = $_POST['durationInTraffic'];
    $startShort = $_POST['startShort'];
    $finishShort = $_POST['finishShort'];
    $startLong = $_POST['startLong'];
    $finishLong = $_POST['finishLong'];
    $startCoorders = $_POST['startCoorders'];
    $finishCoorders = $_POST['finishCoorders'];
    $priority = $_POST['priority'];
    $price = $_POST['price'];
    $rate = $_POST['rate'];
    $paymentType = $_POST['paymentType'];
    $userLogin = $_POST['userLogin'];

    $query = "SELECT `id_user` FROM `users` WHERE `login_user` = '".$userLogin."';";
    $user = ($conn->query($query))->fetch_array()["id_user"];
    
    $query = "INSERT INTO `orders` (`id_order`, `date_order`, `timeStart_order`, `timeFinish_order`, `distance_order`, `duration_order`, `durationInTraffic_order`, `startShort_order`, `finishShort_order`, `startLong_order`, `finishLong_order`, `startCoorders_order`, `finishCoorders_order`, `status_order`, `priority_order`, `price_order`, `rate_order`, `paymentType_order`, `user_order`, `taxiDriver_order`, `timeInSearch_order`, `timeInWaitDriver_order`, `timeInDrive_order`, `rating_order`) VALUES (NULL, '".$date."', '".$time."', NULL, '".$distance."', '".$duration."', '".$durationInTraffic."', '".$startShort."', '".$finishShort."', '".$startLong."', '".$finishLong."', '".$startCoorders."', '".$finishCoorders."', 'search', '".$priority."', '".$price."', '".$rate."', '".$paymentType."', '".$user."', NULL, NULL, NULL, NULL, NULL);";
    $res = $conn->query($query);
    
    $query = "SELECT `id_order` FROM `orders` WHERE `user_order` = '".$user."' ORDER BY `id_order` DESC LIMIT 1;";
    $res = ($conn->query($query))->fetch_array();
    
    $json["result"] = $res["id_order"];
    
    print(json_encode($json));
}

?>