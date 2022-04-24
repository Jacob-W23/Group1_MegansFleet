<?php

require_once "config.php";
require_once "utils.php";

session_id($_POST['session']);
session_start();

if ($_SESSION['auth'] && validateInput() && isset($_POST['id']))
{
    $id = $_POST['id'];
    $dotId = $_POST['dotID'];
    $year = $_POST['year'];
    $type = $_POST['type'];
    $make = $_POST['make'];
    $model = $_POST['model'];
    $miles = $_POST['miles'];
    $status = $_POST['status'];
    $maint = $_POST['maintenance'];

    $connection = new mysqli($hn. $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    { //modify if needed
        $stmt = $connection->prepare("UPDATE vehicles SET dotID=?, year=?, type=?, make=?, model=?, miles=?, status=?, maintenance=? WHERE id=?");
        $stmt->bind_param("ssssssssi", $dotId, $year, $type, $make, $model, $miles, $status, $maint, $id);

        if ($stmt->execute())
        {
            $response['outcome'] = "success";
            $response['err-msg'] = "vehicle id $id updated";
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "Could not update vehicle";
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