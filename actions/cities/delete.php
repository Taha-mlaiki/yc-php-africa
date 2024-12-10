<?php 
    include "../../inc/connDB.php";

    $cityId = filter_input(INPUT_POST,'deleteCity',FILTER_SANITIZE_NUMBER_INT);
    if(!$cityId || !is_numeric($cityId)){
        echo " Id no valid";
        exit();
    }

    $sql = "DELETE FROM city WHERE id = $cityId";
    $res = mysqli_query($conn,$sql);
    if(!$res){
        echo "Query faild";
        exit();
    }

    $refferUrl = $_SERVER["HTTP_REFERER"] ?? "../../index.php";

    header("location: $refferUrl");



