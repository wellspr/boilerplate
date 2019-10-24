<?php
use FormCreate\Form as Form;
use Mongo\Access as Access;
use Mongo\User as User;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$register = new Form();
$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();


if ($_SERVER['REQUEST_METHOD']==='POST') {

    $username = $_POST['username'];

    $firstName = '';
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
    // $username = '';
    $email = '';
    $password = '';

    $filter = ['username' => $username];

    $options = [];

    $foundUser = $user->read($filter, $options);

    foreach ($foundUser as $user) {

        // echo $user->username;

        $firstName = $user->name->firstName;
        $lastName = $user->name->lastName;
        $street = $user->adress->street;
        $number = $user->adress->number;
        $complement = $user->adress->complement;
        $bairro = $user->adress->bairro;
        $zip = $user->adress->zip;
        $city = $user->adress->city;
        $state = $user->adress->state;
        $country = $user->adress->country;
        $telResidencial = $user->telephone->residencial;
        $telCelular = $user->telephone->celular;
        // $username = ;
        $email = $user->account->email;
        $password = $user->account->password;

    }

}

$register->setFormTitle('Register');
$register->setActionURL("/user/update");
$register->setCSS('/resources/css/forms.css');


$pathToRegisterFields = $_SERVER['DOCUMENT_ROOT'] . "/forms/registerFields.php";
include($pathToRegisterFields);

$options = [
    'groupField' => 'Dados de Login',
    'field' => 'username',
    'attribute' => 'disabled',
    'value' => true
];


$register->setFields($registerFields);

$register->setFormAttributeValue($options);

$values = [
    $firstName,
    $lastName,
    $street,
    $number,
    $complement,
    $bairro,
    $zip,
    $city,
    $state,
    $country,
    $telResidencial,
    $telCelular,
    $username,
    $email,
    $password
];

$register-> setValues($values);

$pathToEditButtons = $_SERVER['DOCUMENT_ROOT'] . "/forms/editButtons.php";
include($pathToEditButtons);
$register->setButtons($editButtons);

$register->create();

?>





<!-- <form class="register" action="/user/update" name="register" method="post">

    <label>Nome</label>

        <div class="formfield">
            <label for="firstName">Nome: </label>
            <input type="text" name="firstName" value="<?=$firstName?>">
            <label for="lastName">Sobrenome: </label>
            <input type="text" name="lastName" value="<?=$lastName?>">
        </div>


    <label>Endereço</label><br>

        <div class="formfield">

            <div class="formsubfield">
                <label for="street">Logradouro</label>
                <input type="text" name="street" value="<?=$street?>">
            </div>

            <div class="formsubfield">
                <label for="number">Número</label>
                <input type="text" name="number" value="<?=$number?>">

                <label for="complement">Complemento</label>
                <input type="text" name="complement" value="<?=$complement?>">
            </div>

            <div class="formsubfield">
                <label for="bairro">Bairro</label>
                <input type="text" name="bairro" value="<?=$bairro?>">

                <label for="zip">Cep</label>
                <input type="text" name="zip" value="<?=$zip?>">
            </div>

            <div class="formsubfield">
                <label for="city">Cidade</label>
                <input type="text" name="city" value="<?=$city?>">

                <label for="state">Estado</label>
                <input type="text" name="state" value="<?=$state?>">

                <label for="country">País</label>
                <input type="text" name="country" value="<?=$country?>">
            </div>

        </div>


    <label>Telefones</label>

        <div class="formfield">

            <div class="formsubfield">
                <label for="telResidencial">Telefone Residencial</label>
                <input type="tel" name="telResidencial" value="<?=$telResidencial?>">
            </div>

            <div class="formsubfield">
                <label for="telCelular">Telefone Celular</label>
                <input type="tel" name="telCelular" value="<?=$telCelular?>">
            </div>

        </div>


    <label>Dados de login</label>

        <div class="formfield">

            <div class="formsubfield">
                <label for="username">Username</label><br>
                <input type="text" name="username" value="<?=$username?>"><br>
            </div>

            <div class="formsubfield">
                <label for="email">Email</label><br>
                <input type="email" name="email" value="<?=$email?>"><br>
            </div>

            <div class="formsubfield">
                <label for="password">Password</label><br>
                <input type="password" name="password" value="<?=$password?>"><br>
            </div>

        </div>

    <input type="submit" name="submit" value="Alterar">
    <input type="button" name="cancel" value="Cancelar Edição">

</form> -->


<script>
    document.querySelector("input[name=cancel]").addEventListener("click", function(){
        window.location.replace("/user/panel");
    });
</script>
