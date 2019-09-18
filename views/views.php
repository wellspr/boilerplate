<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="google-signin-client_id" content="754097660716-cgsq9hg67ovjpkqcefmubn91tpm14tev.apps.googleusercontent.com">
    <script src="https://apis.google.com/js/platform.js?onload=renderButton" async defer></script>
    <title><?php echo $title?></title>

  </head>
  <body>

    <?php
    $file = $contentDirectory . "/" . $contentFileName . ".php";
    if(file_exists($file)){
      include $file;
    }
    ?>

  </body>
</html>
