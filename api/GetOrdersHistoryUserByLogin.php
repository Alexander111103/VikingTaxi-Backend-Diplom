<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST["login"];
    $idUser = ($conn->query("SELECT `id_user` FROM `users` WHERE `login_user` = '".$login."';"))->fetch_array()["id_user"];

    $query = "SELECT * FROM `orders` WHERE (`user_order` = '".$idUser."' AND (`status_order` = 'end' OR `status_order` = 'canseled')) ORDER BY `id_order` DESC;";

    $res = $conn->query($query);

    $value = array();

    foreach($res as $auto)
    {
        array_push($value, $auto);
    }

    $json['orders'] = $value;

    print(json_encode($json));
}
?>