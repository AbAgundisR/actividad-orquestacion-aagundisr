<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
  
// database connection will be here
// include database and object files
include_once '../config/config.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// Prepare a select statement
$sql = "SELECT * FROM Reticula";

if($result = mysqli_query($db, $sql)){
    $materias_arr=array();
    $materias_arr["materias"]=array();

    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_array($result)){
            extract($row);

            $materia_item=array(
                "id" => $id,
                "nombre" => $nombre,
                "semestre" => $semestre
            );

            array_push($materias_arr["materias"], $materia_item);
        }

        // set response code - 200 OK
        http_response_code(200);
    
        // show products data in json format
        echo json_encode($materias_arr);
    }
} else {
    echo 'a';
}
?>