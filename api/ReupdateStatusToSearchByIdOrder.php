<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $id = $_POST['id'];

    $query = "UPDATE `orders` SET `status_order` = 'search', `taxiDriver_order` = NULL WHERE `id_order` = '".$id."';";
    $res = $conn->query($query);

    $json["result"] = "1";

    print(json_encode($json));
}
?>