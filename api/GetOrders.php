<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $rate = $_POST["rate"];
    $isChildSeet = $_POST["isChildSeet"];

    $query = "SELECT * FROM `orders` WHERE (`status_order` = 'search' OR `status_order` = 'searched') AND ( `rate_order` = 'base'";

    if($rate == "business")
    {
        $query = $query." OR `rate_order` = 'business'";
    }

    if($isChildSeet == "1")
    {
        $query = $query." OR `rate_order` = 'child'";
    }

    $query = $query.") ORDER BY `priority_order` DESC, `date_order`, `timeStart_order`;";

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