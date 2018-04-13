<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 13.04.2018
 * Time: 16.00
 */

namespace skirenndatabase;

require_once "Head.php";
require_once "Header.php";
require_once "footer.php";
require_once "Authenticator.php";

session_start();
$header = new Header();
$head = new Head();
echo $head->getHtml().$header->getHTML();
echo '<script type="text/javascript"> 
function validateInput(){
    var inputRegex = /^[a-zA-Z0-9]*$/;
    
    var loginNameInput = document.getElementById("login_name").value;
    var passwordInput = document.getElementById("password").value;
    console.log(loginNameInput);
    console.log(passwordInput);
    
    var nameResult = inputRegex.test(loginNameInput);
    var passwordResult = inputRegex.test(passwordInput);
    
    if(nameResult == true && passwordResult == true){
        formPost(loginNameInput, passwordInput)
    }
    console.log("booooo!");
}

function formPost(login_name, password) {
  var form = document.getElementById("login_form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "");
  
    form.submit();
}



</script>';
//Content
echo '<div class="w3-container w3-teal">
  <h2>Admin innlogging</h2>
</div>

<form class="w3-container" id="login_form">
  <label class="w3-text-teal"><b>Brukernavn</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="login_name" id="login_name">
  
  <label class="w3-text-teal"><b>Passord</b></label>
  <input class="w3-input w3-border w3-light-grey" type="password" name="password" id="password">
    
  <input type="hidden" name="submitted" >
  <button class="w3-btn w3-blue-grey" onclick="validateInput()">Logg inn</button>
</form>


<br>';


    if (isset($_POST["submitted"])) {
        $login_name = $_POST["login_name"];
        $password = $_POST["password"];

        if($login_name == "" && $login_name == null){
            echo "Vennligst oppgi brukernavn og passord";
        }
        elseif($password == "" && $password == null){
            echo "Vennligst oppgi brukernavn og passord";
        }
        else{
            $auth = new Authenticator();
            $_SESSION["admin"] = $auth->isAdmin($login_name, $password);
            if($_SESSION["admin"] == true){
                echo "Logget inn!";
            }
            else{
                echo "Feil Passord eller Brukernavn";
            }
        }

    }

$footer = new Footer();
echo $footer->getHTML();




