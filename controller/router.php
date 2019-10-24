<?php

use Router\Route as App;

$app = new App();

// Home page
$app -> setRoute("/", function($req, $res) {
    $res -> render("views", [
        'title' => 'Home',
        'contentDirectory' => "content",
        'contentFileName' => "home"
    ]);
});

// Rotas para tratamento de dados de usuário
$app -> setRoute("/user/:id", function($req, $res) {

$id = $req -> params('id');

        if ($id=='') {
            // Protected
            if (isset($_SESSION['id'])) {

                $res -> render("userViews", [
                    'title' => 'User',
                    'contentDirectory' => "user",
                    'contentFileName' => "user"
                ]);

            } else {

                $res->redirect("/login");

            }

        } else if ($id==='profile') {
            // Protected
            if (isset($_SESSION['id'])) {

                $res -> render("userViews", [
                    'title' => 'Perfil do Usuário',
                    'contentDirectory' => "user",
                    'contentFileName' => "profile"
                ]);

            } else {

                $res->redirect("/login");

            }

        } else if ($id==='create') {

            $res -> render("userViews", [
                'title' => 'Create New User',
                'contentDirectory' => "user",
                'contentFileName' => "create"
            ]);

        } else if ($id==='register') {

            $res -> render("userViews", [
                'title' => 'Create New User',
                'contentDirectory' => "user",
                'contentFileName' => "register"
            ]);

        } else if ($id==='read') {

            $res -> render("userViews", [
                'title' => 'Find User',
                'contentDirectory' => "user",
                'contentFileName' => "read"
            ]);

        } else if ($id==='edit') {

            $res -> render("userViews", [
                'title' => 'Edit User',
                'contentDirectory' => "user",
                'contentFileName' => "edit"
            ]);

        } else if ($id==='update') {

            $res -> render("userViews", [
                'title' => 'Update User',
                'contentDirectory' => "user",
                'contentFileName' => "update"
            ]);

        } else if ($id==='delete') {

            $res -> render("userViews", [
                'title' => 'Delete User',
                'contentDirectory' => "user",
                'contentFileName' => "delete"
            ]);

        }

});

$app -> setRoute("/admin/:id", function($req, $res) {

    $id = $req -> params('id');

    // Verify route
    if ($id==='panel') {

        // Verify user is Loggedin AND is administrator
        if (isset($_SESSION['id'])&&$_SESSION['username']==='admin') {
            // Admin acess
            $res -> render("userViews", [
                'title' => 'Admin',
                'contentDirectory' => "admin",
                'contentFileName' => "panel"
            ]);

        } else {
            // Anauthorized user
            $res->render("userViews", [
                'title' => 'Admin',
                'contentDirectory' => "admin",
                'contentFileName' => "anauthorized"
            ]);

        }

    }

});


// Rotas para tratamento de autorização de acesso
$app -> setRoute("/:id", function($req, $res) {

$id = $req -> params('id');

    if ($id==='login') {
        $res -> render("views", [
            'title' => 'Login',
            'contentDirectory' => "auth",
            'contentFileName' => "login"
        ]);
    } else if ($id==='loginValidate') {
        $res -> render("views", [
            'title' => 'Register',
            'contentDirectory' => "auth",
            'contentFileName' => "loginValidate"
        ]);
    } else if ($id==='logout') {
        $res -> render("views", [
            'title' => 'Logout',
            'contentDirectory' => "auth",
            'contentFileName' => "logout"
        ]);
    }
});


// Rotas para tratamento de autorização de acesso
$app -> setRoute("/google/:id", function($req, $res) {

$id = $req -> params('id');

    if ($id==='login') {
        $res -> render("views", [
            'title' => 'Google Login',
            'contentDirectory' => "auth",
            'contentFileName' => "google-login"
        ]);
    } else if ($id==='login-via-js') {
        $res -> render("views", [
            'title' => 'Google Login vis js',
            'contentDirectory' => "auth",
            'contentFileName' => "google-login-via-js"
        ]);
    }
});


// Rotas para tratamentos de erros
$app -> setRoute("/error/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='403') {

        $res -> render("views", [
            'title' => '403',
            'contentDirectory' => "error",
            'contentFileName' => "403"
        ]);

    } else if ($id==='404'){

        $res -> render("views", [
            'title' => '404',
            'contentDirectory' => "error",
            'contentFileName' => "404"
        ]);

    }

});

// Rotas para testes de http requests
$app -> setRoute("/http/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='teste-curl'){

        $res -> render("views", [
            'title' => 'Teste cURL',
            'contentDirectory' => "http",
            'contentFileName' => "teste-curl"
        ]);

    } else if ($id==='teste-curlGet'){

        $res -> render("views", [
            'title' => 'Teste cURL: GET',
            'contentDirectory' => "http",
            'contentFileName' => "teste-curlGet"
        ]);

    } else if ($id==='teste-curlPost'){

        $res -> render("views", [
            'title' => 'Teste cURL: POST',
            'contentDirectory' => "http",
            'contentFileName' => "teste-curlPost"
        ]);

    }

});

// Rotas para testes no MongoDB
$app -> setRoute("/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='dbConnect') {

        $res -> render("dbViews", [
            'title' => 'DB Connection',
            'contentDirectory' => "db",
            'contentFileName' => "dbConnect"
        ]);

    } else if ($id==='dbTestClasses') {

        $res -> render("dbViews", [
            'title' => 'DB test Classes',
            'contentDirectory' => "db",
            'contentFileName' => "dbTestClasses"
        ]);

    } else if ($id==='dbGetAccess') {

        $res -> render("dbViews", [
            'title' => 'DB Get Access',
            'contentDirectory' => "db",
            'contentFileName' => "dbGetAccess"
        ]);

    } else if ($id==='userRead') {

        $res -> render("dbViews", [
            'title' => 'Read User Info',
            'contentDirectory' => "db",
            'contentFileName' => "userRead"
        ]);

    }  else if ($id==='userReadOne') {

        $res -> render("dbViews", [
            'title' => 'Read User Info',
            'contentDirectory' => "db",
            'contentFileName' => "userReadOne"
        ]);

    } else if ($id==='userReadMany') {

        $res -> render("dbViews", [
            'title' => 'Read User Info',
            'contentDirectory' => "db",
            'contentFileName' => "userReadMany"
        ]);

    }

});


// Rotas de teste e exemplos do que pode ser feito

$app -> setRoute("/get_params", function($req, $res) {

    $req_uri = $req->get_request_uri();
    $params = $req->get_query_params($req_uri);

    // Load a URL of the website:

    if (isset($params['title'])) {
        $title = $params['title'];
    } else {
        $title = "Get User Params";
    }

    if (isset($params['file_name'])) {
        $file_name = $params['file_name'];
    } else {
        $file_name = 'get_params';
    }

    if (isset($params['dir_name'])) {
        $dir_name = $params['dir_name'];
    } else {
        $dir_name = 'user';
    }

    $res -> render("views", [
        'title' => "$title",
        'contentDirectory' => "$dir_name",
        'contentFileName' => "$file_name"
    ]);

});


$app -> setRoute("/:id", function($req, $res) {

$id = $req -> params('id');

    // if ($id=='') {
    //
    //     $res->send("Home!!!");
    //
    // } else
    if ($id=='hello') {

        $res->send("Hello!!!");

    } else if ($id=='good-bye') {

        $res->send("Good Bye!!!");

    }

});


$app -> setRoute("/:id1/:id2", function($req, $res) {

    $id1 = $req->params('id1');
    $id2 = $req->params('id2');

    if($id1==='hello'&&$id2==='dear'){

        $res->send("$id1 $id2");

    } else if ($id1==='banana'&&$id2==='prata') {
        $res->send("$id1 $id2");
    }
});


$app -> setRoute("/testes/:id1/case/:id2", function($req, $res){

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');

    if ($id1=="1"&&$id2=="2") {
        $res->send("Deu certo:" . '/testes/'. $id1 . '/case/' . $id2);
    }else if ($id1=="3"&&$id2=="4") {
        $res->send("Deu certo:" . '/testes/'. $id1 . '/case/' . $id2);
    }
});


$app -> setRoute("/teste/:id1/:id2/:id3", function($req, $res){

    $id1 = $req -> params('id1');
    $id2 = $req -> params('id2');
    $id3 = $req -> params('id3');

    if($id1==='1'&$id2==='2'&$id3==='3'){
        $res->send("Hello! from: /teste/$id1/$id2/$id3");
    }

});


$app -> setRoute("/teste", function($req, $res) {

    $res->send("Testing My Darling...");

});


$app -> setRoute("/Hello/MyDarling", function($req, $res) {

    $res->send("Hello My Darling!!!");

});

// Exibe o phpinfo
$app -> setRoute("/:id", function($req, $res) {

    $id = $req->params("id");

    if ($id==='phpinfo'){

        $res->send(phpinfo());

    }

});
