<h1>Painel</h1>


<form class="searchBox" action="/user/panel" method="post">

    <input type="text" name="username" placeholder="Username">
    <input type="submit" name="submit" value="Exibir">

</form>


<?php

use Mongo\Access as Access;
use Mongo\User as User;
use HttpRequest\Http as Http;

/*  include functions:
*   Incluindo o arquivo functions.php
*   Função utilizada: displayArray
*/
include $_SERVER['DOCUMENT_ROOT'] . "/functions/functions.php";

$accessUri = Access :: clusterAccessUri();
$user = new User($accessUri);
$user->define();


if (($_SERVER['REQUEST_METHOD'])==='POST') {

    $username = $_POST['username'];

    $filter = ['username' => $username];

    $options = [
        'projection' => [
            '_id' => 0,
            'username' => 0,
            'account.password' => 0
        ]
    ];

    $foundUsers = $user->read($filter, $options);


    foreach ($foundUsers as $value) {

        $var = json_decode(json_encode(($value)), true);

        foreach ($var as $key => $topic) {

            echo ucfirst($key) . "<br>";

                displayVar($topic);

        }

    echo <<<EXCERPT
    <table><tr>
        <td>
        <form action='/user/edit' method='post'>
        <input type='hidden' name='username' value='$username'>
        <input type='submit' name='update' value='Editar'></form>
        </td>

        <td>
        <form>
        <input type='hidden' name='username' value='$username'>
        <input type='button' name='delete' value='Deletar'></form>
        </td>
    </tr></table>
EXCERPT;
    }

} else {

    echo "Faça uma busca... <br>";

}



// Lista os usernames dos usuários
echo "==================<br>";
$filter = [];

$options = [
    'projection' => [
        '_id' => 0,
        'username' => 1
        // 'account.password' => 0
    ]
];

$foundUsers = $user->read($filter, $options);

echo "<table>";

$users = [];

foreach ($foundUsers as $row) {

    foreach ($row as $value) {

        array_push($users, $value);

    }

}

foreach ($users as $user) {
    echo "<tr>";

    echo "<td><span class='loginSelect'>" . $user . "</span></td>";

    echo "<td>
    <form action='/user/edit' method='post'>
    <input type='hidden' name='username' value='$user'>
    <input type='submit' name='update' value='Editar'></form></td>";

    echo "<td>
    <form>
    <input type='hidden' name='username' value='$user'>
    <input type='button' name='delete' value='Deletar'></form></td>";

    echo "</tr>";
}

echo "</table>";
// Fim da listagem dos usernames dos usuários
echo "==================<br>";


?>



<script>

document.addEventListener("click", function(event){

    let input = document.querySelector("input[name='username']");
    input.addEventListener("change", function(){
        document.querySelector(".searchBox").submit();
    });

    if (event.target.classList.contains("loginSelect")) {

        let thisTarget = event.target;
        let username = thisTarget.innerText;
        let input = document.querySelector("input[name='username']");

        input.value=username;

    }

});


let count = 0;
let value = "";

document.addEventListener("click", function(event){

    console.log(event.target.innerHTML);
    let thisTarget = event.target;

    if (thisTarget.classList.contains("editable")&&count===0) {

        count+=1;

        console.log(thisTarget);
        console.log(value);
        console.log(count);

        value = thisTarget.innerText;

        thisTarget.classList.add("myTarget");

        thisTarget.innerHTML="<input class='myInput' type='text' name='myChange' value=' " + value + " '> <input type='submit' name='submit' value='Confirma'>";

    } else if (thisTarget.classList.contains("myInput")) {

        console.log(thisTarget);
        console.log(value);


    } else {

        console.log("clicked outside...");
        // console.log(value);

        let input = document.querySelector(".myInput");

        // let value = input.value;
        console.log(value);

        let myTarget = document.querySelector(".myTarget")
        console.log(myTarget);

        // myTarget.innerHTML=value;

        myTarget.classList.remove("myTarget");

        count = 0;
        console.log(count);

        value = "";

    }

});

// Programação dos botões de delete user
let deleteBtns = document.querySelectorAll("input[name=delete]");

deleteBtns.forEach((btn) => {

    btn.addEventListener("click", (event) => {

        let username = event.target.previousElementSibling.value;

        let action = confirm("Deseja deletar usuário " + username + "? \nEsta ação não pode ser revertida.");

        if (action===true) {

            var xhttp = new XMLHttpRequest();

            xhttp.open("POST", "/user/delete", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("username="+username);

            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                  location.reload();
                }
            };
        }
    });
});

</script>
