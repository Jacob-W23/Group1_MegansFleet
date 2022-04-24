<?php

require_once "config.php";

session_id($_POST['session']);
session_start();

if ($_SESSION['auth'] && isset($_POST['id']))
{
    $id = $_POST['id'];

    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        $stmt = $connection->prepare("DELETE FROM vehicles WHERE id=?"); //modify as needed
        $stmt->bind_param("i", $id);

        if ($stmt->execute())
        {
            $response['outcome'] = "success";
            $response['err-msg'] = "vehicle id $id deleted";
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "could not delete vehicle";
        }

        $stmt->close();
    }

    $connection->close();
}
else
{
    $response['outcome'] = "error";
    $response['err-msg'] = "Not authorized";
}

echo json_encode($response);

?>