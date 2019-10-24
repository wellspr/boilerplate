<h1>Update User</h1>

<?php

use Mongo\Access as Access;
use Mongo\User as User;

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $street = $_POST['street'];
    $number = $_POST['number'];
    $complement = $_POST['complement'];
    $bairro = $_POST['bairro'];
    $zip = $_POST['zip'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $country = $_POST['country'];
    $telResidencial = $_POST['telResidencial'];
    $telCelular = $_POST['telCelular'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

$query = ['username' => $username];

$options = ['$set' => [
        'username' => $username,

        'name' => [
            'firstName' => $firstName,
            'lastName' => $lastName
        ],

        'adress' => [
            'street' => $street,
            'number' => $number,
            'complement' => $complement,
            'bairro' => $bairro,
            'zip' => $zip,
            'city' => $city,
            'state' => $state,
            'country' => $country
        ],

        'telephone' => [
            'residencial' => $telResidencial,
            'celular' => $telCelular
        ],

        'account' => [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]
    ]
];

$user->update($query, $options);

}
