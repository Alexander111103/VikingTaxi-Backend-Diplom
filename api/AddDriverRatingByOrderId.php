<?php 

if($_GET['Api_key'] == "k6uy6ien-v9cj-wi5h-nnd0-skp7m423s8jo")
{
    include("includes/conn.php");

    $id = $_POST['id'];
    $rating = $_POST['rating'];

    $driverRatingInfo = ($conn->query("SELECT `drivers`.`id_driver`, `drivers`.`rating_driver`, `drivers`.`numberRatings_driver` FROM `orders` JOIN `drivers` ON `drivers`.`id_driver` = `orders`.`taxiDriver_order` WHERE `id_order` = '".$id."';"))->fetch_array();
    $newNumberRating = $driverRatingInfo["numberRatings_driver"] + 1;
    $newRating = ($driverRatingInfo["rating_driver"] * $driverRatingInfo["numberRatings_driver"] + $rating) / $newNumberRating;

    $query = "UPDATE `drivers` SET `rating_driver` = '".$newRating."', `numberRatings_driver` = '".$newNumberRating."' WHERE `drivers`.`id_driver` = '".$driverRatingInfo["id_driver"]."';";
    $res = $conn->query($query);

    $json["result"] = "1";

    print(json_encode($json));
}
?>