<?php

session_id($_POST['session']);
session_start();

if ($_SESSION['auth'] && validateInput())
{
    $connection = new mysqli($hn, $un, $pw, $db);

    if ($connection->connect_error)
    {
        $response['status'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        //insert query goes here
    }
}

function validateInput()
{
    $fields = array('dotID', 'year', 'type', 'make', 'model', 'miles', 'status', 'maintenance');
    foreach ($fields as $field)
    {
        if (!isset($_POST[$field]))
        {
            return false;
        }
    }

    return true;
}

?>