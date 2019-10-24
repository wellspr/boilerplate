<?php

use Router\Response as Response;
use HttpRequest\Http as Http;
use Mongo\Access as Access;
use Mongo\User as User;

$client = new Google_Client();
$client->setAuthConfig('../credentials/credentials.json');
$client->addScope('profile openid email');

/* Your redirect URI can be any registered URI...

/* Redirect to this page */
$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/google/login';

$client->setRedirectUri($redirect_uri);

/**
 * Set the prompt hint. Valid values are none, consent and select_account.
 * If no value is specified and the user has not previously authorized
 * access, then the user is shown a consent screen.
 * @param $prompt string
 *  {@code "none"} Do not display any authentication or consent screens. Must not be specified with other values.
 *  {@code "consent"} Prompt the user for consent.
 *  {@code "select_account"} Prompt the user to select an account.
*/
// $client->setConfig('prompt', 'select_account');
/* or */
$client->setPrompt("select_account");

// authenticate code from Google OAuth Flow
if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    $client->setAccessToken($token['access_token']);

    // get profile info
    $google_oauth = new Google_Service_Oauth2($client);
    $google_account_info = $google_oauth->userinfo->get();
    $email =  $google_account_info->email;
    $name =  $google_account_info->name;
    $locale = $google_account_info->locale;
    $picture = $google_account_info->picture;
    $verified_email = $google_account_info->verified_email;
    $googleID = $google_account_info->id;

// now you can use this profile info to create account in your website and make user logged in.

// start a new session associated with this user
    $_SESSION['name'] = $name;
    $_SESSION['email'] = $email;
    $_SESSION['id'] = $googleID;
    $_SESSION['picture'] = $picture;
    $_SESSION['locale'] = $locale;
    $_SESSION['verified_email'] = $verified_email;
    $_SESSION['newlogin'] = true;
    $_SESSION['username'] = $email;

/* Make a request call to server to verify if this googleID is already saved
* If Not, create a new user in next step;
* If yes, skip next step.
*/

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();

if (!$user->hasGoogleID($googleID)) {

    // Make an http request to create a new user on server on-the-fly
    $http = new Http();
    $url = 'https://' . $_SERVER['HTTP_HOST'] . '/user/create';
    $data = [
        "username" => $email,
        'name' => $name,
        'email' => $email,
        "googleID" => $googleID,
    ];
    $http->postRequest($url, $data);

}

/*Redirect page to login window:
* Uses Class Response, method redirect
*/
$res = new Response;
$res->redirect("/login");

} else {

    include_once($_SERVER['DOCUMENT_ROOT'] . "/forms/googleLoginButton.php");

}?>
