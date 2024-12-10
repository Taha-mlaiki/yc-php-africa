<?php
include "../../inc/connDB.php";

function transformInput($value)
{
    $value = htmlspecialchars($value);
    $value = trim($value);
    return $value;
}


if (isset($_POST["submit"])) {
    $cityId = transformInput($_POST["cityId"]);
    $name = transformInput($_POST["name"]);
    $description = transformInput($_POST["description"]);
    $type = transformInput($_POST["type"]);
    $imageUrl = filter_input(INPUT_POST, "imageUrl", FILTER_SANITIZE_URL);
    $imageUrl = transformInput($imageUrl);
    

    if (empty($name) || empty($description) || empty($type) ){
        echo "somthing empty";
        return;
    }

    $sql = "UPDATE city SET name = '$name',description = '$description',type = '$type',image = '$imageUrl'  WHERE id = $cityId  ;";
    
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $reffer = $_SERVER["HTTP_REFERER"] ?? "../index.php";
        header("location: $reffer");
    }
}
