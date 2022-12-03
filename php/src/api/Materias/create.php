<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
  
if($_SERVER["REQUEST_METHOD"] != "POST"){
    echo 'not post';
}

include_once '../config/config.php';
include_once '../model/Materia.php';
  
// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$materia = new Materia();

$data = json_decode(file_get_contents("php://input"));

if(!empty($data->id) && !empty($data->nombre) && !empty($data->semestre)){
    // set product property values
    $materia->id = $data->id;
    $materia->nombre = $data->nombre;
    $materia->semestre = $data->semestre;
}

// Prepare a select statement
$sql = "INSERT INTO Reticula (id, nombre, semestre) VALUES (?, ?, ?)";

if($stmt = mysqli_prepare($db, $sql)){
    // Bind variables to the prepared statement as parameters
    mysqli_stmt_bind_param($stmt, "sss", $param_id, $param_nombre, $param_semestre);
    
    // Set parameters
    $param_id = $materia->id;
    $param_nombre = $materia->nombre;
    $param_semestre = $materia->semestre;
    
    // Attempt to execute the prepared statement
    if(mysqli_stmt_execute($stmt)){
        // tell the user
        echo json_encode(array("message" => "Materia creada."));
    } else{
        echo "Oops! Something went wrong. Please try again later.";
    }

    // Close statement
    mysqli_stmt_close($stmt);
}

// Close connection
mysqli_close($db);
?>