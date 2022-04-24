<?php

require_once "config.php";
require_once "utils.php";

session_id($_POST['session']);
session_start();

if ($_SESSION['auth'] && validateInput())
{
    $id = null;
    $dotId = $_POST['dotID'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $miles = $_POST['miles'];
    $status = $_POST['status'];
    $maint = $_POST['maintenance'];

    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['status'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        $stmt = $connection->prepare("INSERT INTO vehicles VALUES(?,?,?,?,?,?,?,?,?)"); // modify as needed
        $stmt->bind_param("issssssss", $id, $dotId, $year, $type, $make, $model, $miles, $status, $maint);

        if ($stmt->execute())
        {
            $id = $connection->insert_id;
            $response['outcome'] = "success";
            $response['err-msg'] = "vehicle inserted as id $id";
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "vehicle could not be inserted";
        }

        $stmt->close();
    }

    $connection->close();
}
else
{
    $response['outcome'] = "error";
    $response['err-msg'] = "Not authorized or incomplete data";
}

echo json_encode($response);

?>