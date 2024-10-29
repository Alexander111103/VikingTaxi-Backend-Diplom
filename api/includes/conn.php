<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

$server_name = "localhost";
$user_name = "root";
$password = "";
$bd = "VikingTaxi";

$conn = new mysqli($server_name, $user_name, $password, $bd);

$json = array();

date_default_timezone_set("Europe/Samara");
?>