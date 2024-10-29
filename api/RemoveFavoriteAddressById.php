<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $id = $_POST['id'];

    $query = "DELETE FROM `favoriteAddresses` WHERE `favoriteAddresses`.`id_favoriteAddresse` = '".$id."';";
    $res = $conn->query($query);

    $json["result"] = "1";

    print(json_encode($json));
}
?>