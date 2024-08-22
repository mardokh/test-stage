
<?php

// * ADMIN REGISTRATION * //

// catching data from js query
$donneesJson = file_get_contents('php://input');

// convert data to php object
$donnees = json_decode($donneesJson);

// Check inputs
if(!empty($donnees->firstName) && !empty($donnees->lastName) && !empty($donnees->email) && !empty($donnees->password)) {

    try {
        // connect to database
        require_once("./db.connect.php");

        // password hash
        $hashedPassword = password_hash($donnees->password, PASSWORD_DEFAULT);

        // comparing data check
        $select_query = "INSERT INTO admins (firstName, lastName, email, password) VALUES (?, ?, ?, ?)";

        // prepare request
        $objt_query = $connexion->prepare($select_query);

        // bind the values
        $objt_query->bindValue(1, $donnees->firstName);
        $objt_query->bindValue(2, $donnees->lastName);
        $objt_query->bindValue(3, $donnees->email);
        $objt_query->bindValue(4, $hashedPassword);

        // execute request
        $objt_query->execute();

        // send sucess response
        echo json_encode(['successfully_registered' => 'you are successfully registred']);
    }
    // Handle errors
    catch (PDOException $e) {
        echo json_encode(['registration_failed' => ' error during registration process : ' . $e->getMessage()]);
    }

}


?>