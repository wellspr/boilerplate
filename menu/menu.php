<a href="/">Home</a>

<?php

    if (!isset($_SESSION['id'])) {

        echo <<<EXCERPT

        | <a href="/login">Login</a>

        | <a href="/user/register">Registrar</a>

EXCERPT;

} else {

    echo <<<EXCERPT

    | <a href="/user/profile">Perfil</a>

EXCERPT;

}

?>
