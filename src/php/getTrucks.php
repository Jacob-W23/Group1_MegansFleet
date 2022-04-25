<?php
//will likely be modified when db is finished.
require_once "config.php";

session_id($_POST['session']);
session_start();

if ($_SESSION['auth'])
{
    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        $stmt = $connection->prepare("SELECT * FROM vehicles");
        if ($stmt->execute())
        {
            $vehiclesResult = $stmt->get_result();
            $numRows = $vehicles->num_rows;

            if ($numRows > 0)
            {
                $response['outcome'] = "success";
                $vehicles = [];

                foreach ($vehiclesResult as $vehicle)
                {
                    $vehicles = $vehicle;
                }

                $response['vehicles'] = $vehicles;
            }
            else
            {
                $response['outcome'] = "error";
                $response['err-msg'] = "No vehicles found";
            }

            $vehicles->close();
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "Could not get vehicles";
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