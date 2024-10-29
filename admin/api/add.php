<?php 
if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo") 
{
    include("../../api/includes/conn.php");

    $data = json_decode(file_get_contents("php://input"),true);
    $query = "INSERT INTO `".$data[0]["value"]."` (";

    for ($i=1; $i < count($data); $i++) 
    { 
        $query = $query."`".$data[$i]["key"]."`, ";
    }

    $query = trim($query, ", ");
    $query = $query.") VALUES (";

    for ($i=1; $i < count($data); $i++) 
    { 
        $query = $query."'".$data[$i]["value"]."', ";
    }

    $query = trim($query, ", ");
    $query = $query.");";

    $t = $conn->query($query);
    if($t == false)
    {
        echo 'Ошибка: '.$conn->error;
    }
    else
    {
        echo 'Данные вставлены';
    }
}
?>