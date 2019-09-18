<?php
if(isset($_SESSION['id'])){
  echo 'Logado como ' . $_SESSION['email'] . "<br>";
  echo 'Id de usuário: ' . $_SESSION['id'];
  echo '<br>';
  echo '<a href="/auth/google-login">Trocar Usuário</a>';
  echo ' | ';
  echo '<a href="auth/logout">Log out</a>';
}
else{
  echo '<p>';
  echo '<a href="/auth/google-login">Google Login</a>';
  echo '</p>';
}
