<h1>Read User Info</h1>

<?php include_once($_SERVER['DOCUMENT_ROOT'] . "/menu/menuDB.php") ?>

<p>Método readMany</p>

<?php

use Mongo\Access as Access;
use Mongo\User as User;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

echo "<br>";
echo "Listando alguns usuários: <br><br>";

$queryList = [
    ['username' => 'wells'],
    ['username' => 'picapau'],
    ['username' => 'nico']
];

$foundUsers = $user->readMany($queryList);

    if ($foundUsers) {

        foreach ($foundUsers as $user) {

            displayObject($user);

        }

    }
