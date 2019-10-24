<h1>Delete User</h1>

<?php

use Mongo\Access as Access;
use Mongo\User as User;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();


if ($_SERVER['REQUEST_METHOD']==='POST') {

    $username = $_POST['username'];

    $query = ['username' => $username];

    $user->delete($query);

}


// $id = '5daa6351f4b84446ba77d312';
// $query = ["_id" => new MongoDB\BSON\ObjectID($id)];
