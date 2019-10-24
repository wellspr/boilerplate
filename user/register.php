<?php
use FormCreate\Form as Form;
use Mongo\Access as Access;
use Mongo\User as User;

$register = new Form();
$accessUri = Access :: clusterAccessUri();
$newUser = new User($accessUri);
$newUser->define();

// Define error variables
$firstNameErr = $firstNameErr = $streetErr = $numberErr = $complementErr = $bairroErr = $zipErr = $cityErr = $stateErr = $countryErr = $telResidencialErr = $telCelularErr =
$usernameErr =  $emailErr = $passwordErr = '';

if($_SERVER['REQUEST_METHOD']==='POST'){

    $firstName = $register->clean($_POST['firstName']);
    $lastName = $register->clean($_POST['lastName']);
    $street = $register->clean($_POST['street']);
    $number = $register->clean($_POST['number']);
    $complement = $register->clean($_POST['complement']);
    $bairro = $register->clean($_POST['bairro']);
    $zip = $register->clean($_POST['zip']);
    $city = $register->clean($_POST['city']);
    $state = $register->clean($_POST['state']);
    $country = $register->clean($_POST['country']);
    $telResidencial = $register->clean($_POST['telResidencial']);
    $telCelular = $register->clean($_POST['telCelular']);

    if (!isset($_POST['username'])) {
        $usernameErr = 'A username is required';
    } else {
        $username = $register->clean($_POST['username']);
    }

    if (!isset($_POST['email'])) {
        $emailErr = "A valid email is required";
    } else {
        $email = $register->clean($_POST['email']);
    }

    $password = $register->clean($_POST['password']);

    // Chamar aqui um método para hashing/salting password

    $user = [

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

    ];

    $newUser->create($user);

}

$register->setFormTitle('Register');
$register->setActionURL("/user/register");
$register->setCSS('/resources/css/forms.css');

$pathToRegisterFields = $_SERVER['DOCUMENT_ROOT'] . "/forms/registerFields.php";
include($pathToRegisterFields);

$register->setFields($registerFields);

$pathToRegisterButtons = $_SERVER['DOCUMENT_ROOT'] . "/forms/registerButtons.php";
include($pathToRegisterButtons);

$register->setButtons($registerButtons);

$register->create();

// include_once $_SERVER['DOCUMENT_ROOT'] . "/forms/register.html";


?>

<!-- <span class='teste'>oi</span> -->

<!-- <script>
    document.querySelector("input[name='submit']").addEventListener("click", function(){
        let msg = '<?php echo $firstName?>';
        document.querySelector(".teste").innerText=msg;
    });
</script> -->
