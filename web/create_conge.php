<?php
 
/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
 */
 
// usage : http://localhost/android_connect/create_product.php?price=500&name=Royaume&description=RSC%20Royaume%20139%2042 
 
// array for JSON response
$response = array();
 
// check for required fields
if (isset($_GET['id_conge']) && isset($_GET['datedebut']) && isset($_GET['datefin'])  && isset($_GET['motif']) && isset($_GET['id_employe'])) {
 
    $id_conge = $_GET['id_conge'];
    $datedebut = $_GET['datedebut'];
    $datefin = $_GET['datefin'];
	$motif = $_GET['motif'];
	$id_employe = $_GET['id_employe'];
 
 
    // include db connect class
    require_once __DIR__ . '/db_connect.php';
 
    // connecting to db
    $db = new DB_CONNECT();
	$con = $db->connect();
    
    $con = $db->connect();
    
    // mysql inserting a new row
    $result = $con->query("INSERT INTO conge(id_conge, datedebut, datefin, motif, id_employe) VALUES($id_conge, '$datedebut', '$datefin' , '$motif', $id_employe )");
 
    // check if row inserted or not
    if ($result) {
        // successfully inserted into database
        $response["success"] = 1;
        $response["message"] = "Conge successfully created.";
 
        // echoing JSON response
        echo json_encode($response);
    } else {
        // failed to insert row
        $response["success"] = 0;
        $response["message"] = "Oops! An error occurred.";
		$response["error"] = $con -> error;
 
        // echoing JSON response
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