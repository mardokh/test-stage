<?php

try{
    $connexion = new PDO("mysql:host=127.0.0.1; dbname=dashboardDb", "root", "");
    $connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOExecption $e){
    echo $e->getMessage();
}

?>