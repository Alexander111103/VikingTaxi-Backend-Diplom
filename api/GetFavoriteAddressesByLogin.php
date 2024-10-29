<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];
    $id = ($conn->query("SELECT `id_user` FROM `users` WHERE `login_user` = '".$login."';"))->fetch_array()["id_user"];

    $query = "SELECT * FROM `favoriteAddresses` WHERE `user_favoriteAddresse` = '".$id."';";
    $res = $conn->query($query);

    $value = array();

    foreach($res as $address)
    {
        array_push($value, $address);
    }

    $json['addresses'] = $value;

    print(json_encode($json));
}
?>