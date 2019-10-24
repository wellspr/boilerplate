<h1>New User</h1>

<?php

$accessUri = Mongo\Access :: clusterAccessUri();

$newUser = new Mongo\User($accessUri);
$newUser->define();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $firstName = $_POST['name'];
    $lastName = '';
    $street = '';
    $number = '';
    $complement = '';
    $bairro = '';
    $zip = '';
    $city = '';
    $state = '';
    $country = '';
    $telResidencial = '';
    $telCelular = '';
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = '';
    $googleID = $_POST['googleID'];


    $user = [

        'username' => $username,
        'googleID' => $googleID,

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
            'password' => $password,
        ]

    ];

    $newUser->create($user);
}
