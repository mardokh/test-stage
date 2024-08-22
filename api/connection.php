<?php

session_start();

// catching data from js query
$donneesJson = file_get_contents('php://input');

// convert data to php object
$donnees = json_decode($donneesJson);

if (!empty($donnees->email) && !empty($donnees->password)) {

    try {
        // connect to database
        require_once("./db.connect.php");

        // Query to fetch the user by email only
        $select_query = "SELECT * FROM admins WHERE email = :email";

        // prepare request
        $objt_query = $connexion->prepare($select_query);

        // bind the email value
        $objt_query->bindValue(":email", $donnees->email);

        // execute request
        $objt_query->execute();

        // fetch the result
        $result = $objt_query->fetch(PDO::FETCH_ASSOC);

        // Check if the user exists and verify the password
        if ($result && password_verify($donnees->password, $result['password'])) {
            // create session variables
            $_SESSION['log_success'] = 'successfully connecting';
            $_SESSION['first_name'] = $result['firstName'];
            $_SESSION['last_name'] = $result['lastName'];
            $_SESSION['e_mail'] = $result['email'];

            echo 'connect_success';
        } else {
            // If the password is incorrect or the user does not exist
            echo 'connect_failed';
        }
    }
    // Handle errors
    catch (PDOException $e) {
        echo json_encode(['registration_failed' => ' error during registration process : ' . $e->getMessage()]);
    }

}

?>
