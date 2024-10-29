<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $id = $_POST['idOrder'];

    $query = "SELECT `users`.`phone_user` FROM `orders` JOIN `users` ON `orders`.`user_order` = `users`.`id_user` WHERE `id_order` = '".$id."';";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["phone_user"];

    print(json_encode($json));
}
?>