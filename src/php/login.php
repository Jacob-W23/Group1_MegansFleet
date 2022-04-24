<?php

require_once "config.php";

if (isset($_POSt['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = new mysqli($hn, $un, $pw, $db);
    if($connection->connect_error)
    {
        $response['status'] = 'error';
    }
    else
    {
        $stmt = $connection->prepare("SELECT * FROM users WHERE username=?");//modify query based on db.
        $stmt->bind_param("s", $username);

        if ($stmt->execute())
        {
            $users = $stmt->get_result();

        }
    }
}

?>