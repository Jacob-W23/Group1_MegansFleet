<?php
//will likely be modified when db is finished.
require_once "config.php";

session_id($_POST['session']);
session_start();

$vehicles = [];

$connection = new mysqli($hn, $un, $pw, $db);

if ($connection->connect_error) {
    $response['outcome'] = "error";
    $response['err-msg'] = "Could not connect to database";
} else {
    $stmt = $connection->prepare("SELECT * FROM vehicles");
    if ($stmt->execute()) {
        $result = $stmt->get_result();
        $rows = $result->num_rows;
        if ($rows >= 1) {
            foreach ($result as $vehicle) {
                $vehicles[] = $vehicle;
                $response['outcome'] = "success";
                $response['vehicles'] = $vehicles;
            }
        } else {
            $response['outcome'] = "error";
            $response['err-msg'] = "No vehicles found";
        }
    } else {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not get vehicles";
    }
    $stmt->close();
}

$connection->close();

echo json_encode($response);

?>