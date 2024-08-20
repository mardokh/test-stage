<?php

// * ADMIN CONNECTION * //

// catching data from js query
$donneesJson = file_get_contents('php://input');

// convert data to php object
$donnees = json_decode($donneesJson);

// Check inputs
if(isset($donnees->email) && !empty($donnees->password)) {

    // connect to database
    require_once("./db.connect.php");

    // comparing data check
    $select_query = "SELECT * FROM admins WHERE email = :email AND password = :password";

    // prepare request
    $objt_query = $connexion->prepare($select_query);

    // bind the values
    $objt_query->bindValue(":email", $donnees->email);
    $objt_query->bindValue(":password", $donnees->password);

    // execute request
    $objt_query->execute();

    // check result
    $result = $objt_query->fetch(PDO::FETCH_ASSOC);

    // Send result
    if($result == false){
        echo json_encode(['connected' => true]);
        exit;
    }
    else{
        echo json_encode(['connect_failed' => true]);
    }
}

?>