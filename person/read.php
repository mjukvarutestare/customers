<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
 
// include database and object files
include_once '../config/database.php';
include_once '../objects/person.php';
 
// instantiate database and person object
$database = new Database();
$db = $database->getConnection();
 
// initialize object
$person = new person($db);
 
// query persons
$stmt = $person->read();
$num = $stmt->rowCount();
 
// check if more than 0 record found
if($num>0){
 
    // persons array
    $persons_arr=array();
    $persons_arr["records"]=array();
 
    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);
 
        $person_item=array(
            "id" => $id,
            "name" => $firstname,
            "lastname" => $lastname,
			"occupation" => $occupation
        );
 
        array_push($persons_arr["records"], $person_item);
    }
 
    echo json_encode($persons_arr);
}
 
else{
    echo json_encode(
        array("message" => "No persons found.")
    );
}
?>