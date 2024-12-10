<?php
include "../../inc/connDB.php";

function transformInput($value)
{
    $value = htmlspecialchars($value);
    $value = trim($value);
    return $value;
}


if (isset($_POST["submit"])) {
    $countryId = transformInput($_POST["countryId"]);
    $name = transformInput($_POST["name"]);
    $population = transformInput($_POST["population"]);
    $langue = transformInput($_POST["langue"]);
    $imageUrl = filter_input(INPUT_POST, "imageUrl", FILTER_SANITIZE_URL);
    $imageUrl = transformInput($imageUrl);

    
    if (empty($name) || empty($langue) || empty($population)) {
        echo "somthing empty";
        echo "$name / $langue / $population";
        return;
    }

    $sql = "UPDATE country SET name = '$name',langue = '$langue',population = '$population',image = '$imageUrl'  WHERE id = $countryId  ;";
    
    $res = mysqli_query($conn, $sql);
    if ($res) {
        $reffer = $_SERVER["HTTP_REFERER"] ?? "../index.php";
        header("location: $reffer");
    }
}
