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

$result = $con->query("SELECT * FROM conge");

$row_cnt = $result->num_rows;
  
// check for empty result

if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["conge"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["id_employe"] = $row["id_employe"];
        $product["id_conge"] = $row["id_conge"];
        $product["date_debut"] = $row["date_debut"];
        $product["date_fin"] = $row["date_fin"];
		$product["motif"] = $row["motif"];
 
        // push single product into final response array
        array_push($response["conge"], $product);
    }
    
     // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
} else {
        // no products found
    $response["success"] = 0;
    $response["message"] = "pas de conge trouvés";
 
    // echo no users JSON
    echo json_encode($response);
}


?>