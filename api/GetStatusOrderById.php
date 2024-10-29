<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $id = $_POST['id'];

    $query = "SELECT `status_order` FROM `orders` WHERE `id_order` = '".$id."';";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["status_order"];

    print(json_encode($json));
}
?>