<?php
 header('Content-Type: application/json');
 // Status : On Dev
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table

$con = $db->connect();

$result = $con->query("SELECT * FROM employe");

$row_cnt = $result->num_rows;
  
// check for empty result

if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["employe"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id_employe"] = $row["id_employe"];
        $product["nom_employe"] = $row["nom_employe"];
        $product["prenom_employe"] = $row["prenom_employe"];
        $product["solde_conge"] = $row["solde_conge"];
 
        // push single product into final response array
        array_push($response["employe"], $product);
    }
    
     // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
        // no products found
    $response["success"] = 0;
    $response["message"] = "pas de conge trouv�s";
 
    // echo no users JSON
    echo json_encode($response);
}


?>