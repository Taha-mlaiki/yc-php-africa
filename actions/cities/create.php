<?php 
    include "../../inc/connDB.php";

    function transformInput($value){
        $value = htmlspecialchars($value);
        $value = trim($value);
        return $value;
    }

    $nameError = $descriptionError = $typeError = "";
   
    if(isset($_POST["submit"])){
        $name = transformInput($_POST["name"]);
        $description = transformInput($_POST["description"]);
        $type = transformInput($_POST["type"]);
        $imageUrl = filter_input(INPUT_POST,"imageUrl",FILTER_SANITIZE_URL);
        $imageUrl = transformInput($imageUrl);
        $country_id = transformInput($_POST["countryId"]);
        
        
        
        echo "$name /" . "$description /" . "$type /". "$imageUrl /". "$country_id /";
        if(empty($name) || empty($description) || empty($type) || empty($imageUrl) ){
            echo "somthing empty";
            $nameError = $descriptionError = $typeError = "Field is required";
            return;
        }
        $sql = "INSERT INTO city (name,description,type,image,country_id) VALUES ('$name','$description','$type','$imageUrl','$country_id');";
        $res = mysqli_query($conn,$sql);
        if($res){
            $reffer = $_SERVER["HTTP_REFERER"] ?? "../index.php";
            header("location: $reffer");
        }
    }


?>