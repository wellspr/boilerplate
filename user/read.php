<h1>Read User Info</h1>

<p>Método read</p>

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

$filter = [];

// $filter = [
//     'adress.number' => '66'
// ];

// $id = '5daa47b4f4b844210047d7e2';
// $filter = ["_id" => new MongoDB\BSON\ObjectID($id)];

$options = [
    // 'projection' => [
    //     '_id' => 0,
    //     // 'name' => 1,
    //     // 'adress' => 1,
    //     // 'telephone' => 1
    //     'account.password' => 0
    // ]
];

$foundUsers = $user->read($filter, $options);

    if ($foundUsers) {

        displayObject($foundUsers);

    }
