<h1>Teste cURL</h1>

<?php

use HttpRequest\Http as Http;

$http = new Http();

$url = "https://boilerplate.org/auth/google-login";

echo $http->request($url);
