<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];
    $name = $_POST['name'];
    $coorders = $_POST['coorders'];
    $idUser = ($conn->query("SELECT `id_user` FROM `users` WHERE `login_user` = '".$login."';"))->fetch_array()["id_user"];

    $countName = ($conn->query("SELECT COUNT(*) as 'count' FROM `favoriteAddresses` WHERE `name_favoriteAddresse` = '".$name."' AND `user_favoriteAddresse` = '".$idUser."';"))->fetch_array()["count"];
    if($countName >= 1)
    {
        $name = $name." ".($countName + 1);
    }

    $query = "INSERT INTO `favoriteAddresses` (`id_favoriteAddresse`, `user_favoriteAddresse`, `coorders_favoriteAddresse`, `name_favoriteAddresse`) VALUES (NULL, '".$idUser."', '".$coorders."', '".$name."');";
    $res = $conn->query($query);

    $json["result"] = "1";

    print(json_encode($json));
}
?>