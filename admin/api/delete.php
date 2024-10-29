<?php 
if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo") 
{
    include("../../api/includes/conn.php");

    $data = json_decode(file_get_contents("php://input"),true);
    $first_column = ($conn->query("SHOW COLUMNS FROM `".$data[0]["value"]."`;"))->fetch_array()["Field"];

    $t = $conn->query("DELETE FROM `".$data[0]["value"]."` WHERE `".$data[0]["value"]."`.`".$first_column."` = '".$data[1]["value"]."'");
    if($t == false)
    {
        echo 'Ошибка: '.$conn->error;
    }
    else
    {
        echo 'Удаление прошло успешно';
    }
}
?>