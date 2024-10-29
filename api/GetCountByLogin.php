<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];

    $query = "SELECT COUNT(*) as 'count' FROM `users` WHERE login_user = '".$login."';";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["count"];

    print(json_encode($json));
}
?>