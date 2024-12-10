<?php

$host = "localhost";
$user = "root";
$pass = "";
$db_name = "geografical";

try {
    $conn = mysqli_connect($host,$user,$pass,$db_name);
} catch (\Throwable $th) {
    echo $th;
}