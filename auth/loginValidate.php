<style>
    .error_message{
        color: red;
    }
</style>

<?php

use Mongo\Access as Access;
use Mongo\User as User;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include_once $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $usernameInformed = $_POST['username'];
    $passwordInformed = $_POST['password'];

    if ($user->exists($usernameInformed)) {

        // echo "<p>Ok, user exists</p>";

        if ($user->passwordsMatch($usernameInformed, $passwordInformed)) {

            // echo "<p>Passwords match!!! Success!!!</p>";

            $filter = ['username' => $usernameInformed];
            $options = [];
            $data = $user->read($filter, $options);

            foreach ($data as $user) {
                $firstName = $user->name->firstName;
                $lastName = $user->name->lastName;
                $username = $user->account->username;
                $email = $user->account->email;
                $id = $user->_id;
            }

            $_SESSION['name'] = $firstName . " " . $lastName;
            $_SESSION['email'] = $email;
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['newlogin'] = true;

            echo '<script> window.location.replace("/"); </script>';

        } else {

            echo "<p><span class='error_message'>Sorry, wrong username or password</span></p>";

        }

    } else {

        echo "<p><span class='error_message'>Sorry, user not found on server</p>";

    }

}
