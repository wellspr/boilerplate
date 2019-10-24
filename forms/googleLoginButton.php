<?php

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

?>


<style>
    .center{
        text-align: center;
    }
</style>

    <div class="center">

        <a href="<?=$client->createAuthUrl()?>">
            <img src="/resources/images/google/google-signin-buttons/1x/btn_google_signin_dark_normal_web.png" alt="Google Signin Button">
        </a>

    </div>
