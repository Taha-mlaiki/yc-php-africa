<?php 
    include "../../inc/connDB.php";

    $countryId = filter_input(INPUT_POST,'countryId',FILTER_SANITIZE_NUMBER_INT);
    
    if(!$countryId || !is_numeric($countryId)){
        echo " Id no valid";
        exit();
    }

    $sql = "DELETE FROM country WHERE id = $countryId";
    $res = mysqli_query($conn,$sql);
    if(!$res){
        echo "Query faild";
        exit();
    }

    $refferUrl = $_SERVER["HTTP_REFERER"] ?? "../../index.php";

    header("location: $refferUrl");



