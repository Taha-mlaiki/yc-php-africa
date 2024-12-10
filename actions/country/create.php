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
        $langue = transformInput($_POST["langue"]);
        $population = transformInput($_POST["population"]);
        $imageUrl = filter_input(INPUT_POST,"imageUrl",FILTER_SANITIZE_URL);
        $imageUrl = transformInput($imageUrl);
        $continentId = transformInput($_POST["continentId"]);
    
        if(empty($name) || empty($langue) || empty($population) || empty($imageUrl) ){
            echo "somthing empty";
            $nameError = $descriptionError = $typeError = "Field is required";
            return;
        }
        $sql = "INSERT INTO country (name,langue,population,image,continent_id) VALUES ('$name','$langue','$population','$imageUrl','$continentId');";
        $res = mysqli_query($conn,$sql);
        if($res){
            $reffer = $_SERVER["HTTP_REFERER"] ?? "../index.php";
            header("location: $reffer");
        }
    }

?>