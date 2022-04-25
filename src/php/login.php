<?php

require_once "config.php";

if (isset($_POSt['username']) && isset($_POST['password']))
{
    $username = $_POST['username'];
    $password = $_POST['password'];

    $connection = new mysqli($hn, $un, $pw, $db);

    if($connection->connect_error)
    {
        $response['outcome'] = "error";
        $response['err-msg'] = "Could not connect to database";
    }
    else
    {
        $stmt = $connection->prepare("SELECT * FROM users WHERE username=?");//modify query based on db.
        $stmt->bind_param("s", $username);

        if ($stmt->execute())
        {
            $users = $stmt->get_result();
            $numRows = $users->num_rows;

            if ($numRows > 0)
            {
                foreach ($users as $user)
                {
                    if ($password == $user['password'])
                    {
                        $response['outcome'] = "success";
                        $response['username'] = $username;
                        $response['auth'] = true;

                        session_start();
                        $response['session'] = session_id();
                        $_SESSION['username'] = $username;
                        $_SESSION['auth'] = true;
                    }
                    else
                    {
                        $response['outcome'] = "error";
                        $response['err-msg'] = "Incorrect passord";
                    }
                }
            }
            else
            {
                $response['outcome'] = "error";
                $response['err-msg'] = "This user does not exist";
            }
            
            $users->close();
        }
        else
        {
            $response['outcome'] = "error";
            $response['err-msg'] = "Could not get users";
        }

        $stmt->close();
    }

    $connection->close();
}
else
{
    $response['outcome'] = "error";
    $response['err-msg'] = "Missing username and/or password";
}

echo json_encode($response);

?>