<?php

session_start();

require __DIR__ . '/vendor/autoload.php';

require "autoload.php";

$app = new Route();

// Home page
$app -> setRoute("/", function($req, $res){
  $res -> render("views", [
    'title' => 'Home',
    'contentDirectory' => "content",
    'contentFileName' => "home"
  ]);
});

$app -> setRoute("/user/:id", function($req, $res){

  $id = $req -> params('id');

  if($id==''){
    $res -> render("views", [
      'title' => 'User',
      'contentDirectory' => "user",
      'contentFileName' => "user"
    ]);
  }
  else if($id=='get_params'){

    $req_uri = $req->get_request_uri();
    $params = Request :: get_query_params($req_uri);

    if(isset($params['title'])){
      $title = $params['title'];
    }else{
      $title = "Get User Params";
    }

    if(isset($params['file_name'])){
      $file_name = $params['file_name'];
    }else{
      $file_name = 'get_params';
    }

    if(isset($params['dir_name'])){
      $dir_name = $params['dir_name'];
    }else{
      $dir_name = 'user';
    }

    $res -> render("views", [
      'title' => "$title",
      'contentDirectory' => "$dir_name",
      'contentFileName' => "$file_name"
    ]);

  }
});

$app -> setRoute("/auth/:id", function($req, $res){

  $id = $req -> params('id');

  if($id==''){
    $res -> render("views", [
      'title' => 'Auth',
      'contentDirectory' => "auth",
      'contentFileName' => "auth"
    ]);
  }
  else if($id=='logout'){
    $res -> render("views", [
      'title' => 'Log out',
      'contentDirectory' => "auth",
      'contentFileName' => "logout"
    ]);
  }
  else if($id=='google-login'){
    $res -> render("views", [
      'title' => 'Google Login',
      'contentDirectory' => "auth",
      'contentFileName' => "google-login"
    ]);
  }
  else if($id=='google-login-via-js'){
    $res -> render("views", [
      'title' => 'Google Login vis js',
      'contentDirectory' => "auth",
      'contentFileName' => "google-login-via-js"
    ]);
  }
});
