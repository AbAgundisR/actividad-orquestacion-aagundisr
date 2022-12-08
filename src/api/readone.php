<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// database connection will be here
// include database and object files
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/Materia.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

$data = json_decode(file_get_contents("php://input"));
$id = "";

if (!empty($data->id)) {
    // set product property values
    $id = $data->id;
}

// Prepare a select statement
$sql = "SELECT * FROM Reticula WHERE id = ?";

if ($stmt = mysqli_prepare($db, $sql)) {
    mysqli_stmt_bind_param($stmt, "s", $param_id);

    // Set parameters
    $param_id = $id;

    if ($result = mysqli_stmt_execute($stmt)) {
        $materia = new Materia();

        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

            // Retrieve individual field value
            $materia->id = $row["id"];
            $materia->nombre = $row["nombre"];
            $materia->semestre = $row["semestre"];

            // set response code - 200 OK
            http_response_code(200);

            // show products data in json format
            echo json_encode($materia);
        }
    } else {
        echo 'a';
    }
}
