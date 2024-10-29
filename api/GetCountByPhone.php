<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $phone = $_POST['phone'];

    $query = "SELECT COUNT(*) as 'count' FROM `users` WHERE phone_user = '".$phone."';";
    $res = ($conn->query($query))->fetch_array();

    $json["result"] = $res["count"];

    print(json_encode($json));
}
?>