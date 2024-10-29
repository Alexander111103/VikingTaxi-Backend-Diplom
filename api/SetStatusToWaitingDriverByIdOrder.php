<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $idOrder = $_POST['id'];
    $time = $_POST['time'];

    $oldTime = ($conn->query("SELECT `timeInSearch_order` FROM `orders` WHERE `id_order` = '".$idOrder."';"))->fetch_array()["timeInSearch_order"];

    if($oldTime != NULL)
    {
        $time = date('H:i:s', strtotime($time) + strtotime($oldTime) -strtotime("00:00:00"));
    }

    $query = "UPDATE `orders` SET `status_order` = 'waitingDriver', `timeInSearch_order` = '".$time."' WHERE `id_order` = ".$idOrder.";";
    $res = $conn->query($query);

    $json["result"] = '1';

    print(json_encode($json));
}
?>