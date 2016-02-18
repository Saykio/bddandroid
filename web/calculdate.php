<?php
 
 // Status : On Dev
 
/*
 * Following code will list all the products
 */
 
// array for JSON response
$response = array();

if ( isset($_GET['id_employe'])) {
	$id_employe = $_GET['id_employe'];
 
// include db connect class
require_once __DIR__ . '/db_connect.php';
 
// connecting to db
$db = new DB_CONNECT();
 
// get all products from products table

$con = $db->connect();

$result = $con->query("SELECT datedebut, datefin 
						from conge as c 
						inner join employe as e on c.id_employe = e.id_employe 
						where e.id_employe =$id_employe
						and where id_conge = MAX(id_conge)";
$row_cnt = $result->num_rows;

if ($row_cnt > 0) {
    
    // looping through all results
    // products node
    $response["employe"] = array();
    
     while ($row = mysqli_fetch_array($result)) {
        // temp user array
        $product = array();
        $product["datedebut"] = $row["datedebut"];
		$product["datefin"] = $row["datefin"];
		array_push($response["employe"], $product);
$DatedebutString = (string)$product["datedebut"];
$DatefinString = (string)$product["datefin"];

$dureejour = (strtotime($DatefinString) - strtotime($DatedebutString));
$dureejours = ($dureejour/86400);

echo "durer $dureejours";
    

// update du solde d'un employe
//$result = $con->query("UPDATE employe SET name = '$name', price = '$price', description = '$description' WHERE id_employe = $id_employe");

  // success
    $response["success"] = 1;
 
    // echoing JSON response
    echo json_encode($response);
	}

}else {
        // no products found
    $response["success"] = 0;
    $response["message"] = "pas de conge trouvés";
 
    // echo no users JSON
    echo json_encode($response);
}
}



?>