<p>
  <a href="/">Home</a>
</p>

<?php
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $name = $_POST["name"];
  $email = $_POST["email"];
  $id = $_POST["id"];
  $picture = $_POST["picture"];
  $locale = $_POST["locale"];
  $verified_email = $_POST["verified_email"];

  $_SESSION['name'] = $name;
  $_SESSION['email'] = $email;
  $_SESSION['id'] = $id;
  $_SESSION['picture'] = $picture;
  $_SESSION['locale'] = $locale;
  $_SESSION['verified_email'] = $verified_email;
}

if(isset($name)){
  echo '<h1>Hello ' . $name . '</h1>';
}
else{
  echo '<h1>Hello user</h1>';
}

if(isset($picture)){
  echo '<p><img src="' . $picture . '" alt="profile picture" width="100px"> <br></p>';
}

if(isset($email)){
  echo '<p>Email da conta: ' . $email . '</p>';
}
if(isset($id)){
  echo '<p>Id = ' . $id . '</p>';
}
