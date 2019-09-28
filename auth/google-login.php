<?php

$client = new Google_Client();
$client->setAuthConfig('../credentials/credentials.json');
$client->addScope('profile openid email');

// Your redirect URI can be any registered URI, but in this example
// we redirect back to this same page
// $redirect_uri = 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
$redirect_uri = 'https://' . $_SERVER['HTTP_HOST'] . '/auth/google-login';
$client->setRedirectUri($redirect_uri);

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
  $id = $google_account_info->id;

  // now you can use this profile info to create account in your website and make user logged in.
?>

<div class="profile">

  <p>
    <a href="/">Home</a>
  </p>

  <p>Nome: <?php echo $name?></p>
  <p> Email: <?php echo $email?></p>
  <p> Local: <?php echo $locale?></p>
  <p><img src="<?php echo $picture?>" alt="profile picture" width="100px"> <br></p>
  <p>
    <?php
    if($verified_email){
      echo 'Email Verificado';
    }else{
      echo 'Email não verificado';
    }?>
  </p>
  <p> Id: <?php echo $id?></p>

  <form action="/user/" method="post">
    <input type="hidden" name="id" value="<?php echo $id?>">
    <input type="hidden" name="name" value="<?php echo $name?>">
    <input type="hidden" name="email" value="<?php echo $email?>">
    <input type="hidden" name="verified_email" value="<?php echo $verified_email?>">
    <input type="hidden" name="picture" value="<?php echo $picture?>">
    <input type="hidden" name="locale" value="<?php echo $locale?>">
    <input type="submit" value="ok">
  </form>

</div>

<style>
  .profile{
    text-align: center;
    margin-top: 100px;
  }
</style>

<?php
}
else{
?>

  <button name="googleLogin"><p>Google Login</p></button>
  <a href="<?php echo $client->createAuthUrl()?>"><p>Google Login</p></a>

<?php
}
?>

<script>
document.querySelector("button[name='googleLogin']").onclick=function(){
  window.open("<?php echo $client->createAuthUrl()?>" , "_blank", "width=600,height=500,left=200,top=100");
  console.log("ok")
};
</script>
