<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $login = $_POST['login'];

    $query = "SELECT `role_user` FROM `users` WHERE `login_user`= '".$login."';";
    $res = $conn->query($query);
    $res_query = $res->fetch_array();

    $json["result"] = $res_query["role_user"];

    print(json_encode($json));
}
?>