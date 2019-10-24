<a href="/">Home</a>

<?php if (isset($_SESSION['id'])) {


    if ($_SESSION['username']==='admin') {

        echo <<<EXCERPT

        | <a href="/admin/panel">Painel</a>

EXCERPT;

    }

    echo <<<EXCERPT

    | <a href="/user/profile">Perfil</a>

EXCERPT;

}


?>
