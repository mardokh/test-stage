<?php

try{
    $connexion = new PDO("mysql:host=localhost; dbname=dashboardDb", "jacob", "nevada60012");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOExecption $e){
    echo $e->getMessage();
}

?>