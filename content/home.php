<h1>The Boilerplate Webpage</h1>

<?php

if (isset($_SESSION['id'])) {

    echo "<h2>Welcome " . $_SESSION['name'] . "! </h2>";

} else {

    echo <<<EXCERPT
    <h2>Welcome user!</h2>

    <p>Faça <a href="/login">login</a> para acessar sua conta ou <a href="/user/register">crie uma nova conta</a></p>
EXCERPT;
}

include_once $_SERVER['DOCUMENT_ROOT'] . "/user/profile_short.php";
