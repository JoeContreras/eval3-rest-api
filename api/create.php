<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../config/database.php';
include_once '../class/employees.php';

$database = new Database();
$db = $database->getConnection();

$item = new Employee($db);

$data = json_decode(file_get_contents("php://input"));

$item->lote = $data->lote;
$item->nombre = $data->nombre;
$item->apellido = $data->apellido;
$item->inicio = $data->inicio;
$item->terminacion = $data->terminacion;
$item->tipo = $data->tipo;
$item->numPieza = $data->numPieza;
$item->defPieza = $data->defPieza;

if($item->createEmployee()){
    echo 'Employee created successfully.';
} else{
    echo 'Employee could not be created.';
}
?>