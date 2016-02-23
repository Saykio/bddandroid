<?php
    header('Content-Type: application/json');
 // Status : On Dev
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();

if (isset($_GET['id_employe'])) {
    $id_employe = $_GET['id_employe'];
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table

$con = $db->connect();

$result = $con->query("SELECT solde_conge FROM employe WHERE id_employe = $id_employe");

$row_cnt = $result->num_rows;
  
// check for empty result

if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["employe"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
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
    $response["message"] = "pas de conge trouvés";
 
    // echo no users JSON
    echo json_encode($response);	
}
} else {
    // required field is missing
    $response["success"] = 0;
    $response["message"] = "Required field(s) is missing";
 
    // echoing JSON response
    echo json_encode($response);
}

?>