<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 13.04.2018
 * Time: 16.40
 */

namespace skirenndatabase;

require_once "Head.php";
require_once "Header.php";
require_once "footer.php";
require_once "Authenticator.php";
require_once "SkirennDBHandler.php";
require_once "InputSanitizer.php";

$header = new Header();
$head = new Head();
echo $head->getHtml().$header->getHTML();
echo '<script type="text/javascript"> 
function validateInput(){
    console.log("validate activated")
    var inputRegex = /^[a-zA-Z0-9]*$/;
    //var phoneRegex = /[0-9]{10}$/
    
    var loginNameInput = document.getElementById("login_name").value;
    var passwordInput = document.getElementById("password").value;
    var nameInput = document.getElementById("name").value;
    var addressInput = document.getElementById("address").value;
    //var phoneInput = document.getElementById("phonenr").value;
    
    var loginNameResult = inputRegex.test(loginNameInput);
    var passwordResult = inputRegex.test(passwordInput);
    var nameResult = inputRegex.test(nameInput);
    var addressResult = inputRegex.test(addressInput);
    //var phoneResult = phoneRegex.test(phoneInput);
    
    if(loginNameResult == true && passwordResult == true && nameResult == true && addressResult == true ){
        console.log("success")
        formPost(loginNameInput, passwordInput)
    }
    else{
        console.log("failure");
        var info = document.getElementById("login_attempt_info");
        info.innerHTML = "Vennligst fyll ut alle felter med korrekt data";
    }
}

function formPost(login_name, password) {
  var form = document.getElementById("register_form");
    form.setAttribute("method", "post");
    form.setAttribute("action", "");
  
    form.submit();
} </script>';
//Content
echo '<div class="w3-container w3-teal">
  <h2>Admin innlogging</h2>
</div>
<div class="w3-container">

<form class="w3-container" id="register_form">
  <label class="w3-text-teal"><b>Navn</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="name" id="name">
  
  <label class="w3-text-teal"><b>Addresse</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="address" id="address" >

  <label class="w3-text-teal"><b>Tlf</b></label>
  <input class="w3-input w3-border w3-light-grey" type="number" name="phonenr" id="phonenr">
 
 
  <label class="w3-text-teal"><b>Brukernavn</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="login_name" id="login_name">
  
  <label class="w3-text-teal"><b>Passord</b></label>
  <input class="w3-input w3-border w3-light-grey" type="password" name="password" id="password" >
  <input type="hidden" name="submitted">
  
</form>
<p id="login_attempt_info"></p>
<button class="w3-btn w3-blue-grey" onclick="validateInput()">Registrer</button>
</div>
<br>';


if (isset($_POST["submitted"])) {
    $login_name = $_POST["login_name"];
    $password = $_POST["password"];
    $name = $_POST["name"];
    $phoneNr = $_POST["phonenr"];
    $address = $_POST["address"];

    $login_name = InputSanitizer::sanitizeInput($login_name);
    $password = InputSanitizer::sanitizeInput($password);
    $name = InputSanitizer::sanitizeInput($name);
    $phoneNr = InputSanitizer::sanitizeInput($phoneNr);
    $address = InputSanitizer::sanitizeInput($address);
    $inputIsValid = true;

    foreach ([$login_name, $password, $name, $phoneNr, $address] as $input){
        if($input == false){
            $inputIsValid = false;
        }
    }
    if($inputIsValid){
        $newPerson = new Person($name, $phoneNr, $address);
        $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");

        try{
            if($db->registerNewAdmin($newPerson, $login_name, $password)){
                echo "Registrert";
            }
            else {
                echo "<br>Kunne ikke registrere brukeren";
            }
        }catch (\Exception $err){
            echo "<br>Kunne ikke registrere brukeren";
        }
    }
    else{
        echo "Vennligst ikke bruk spesielle tegn i input feltene";
    }


}

$footer = new Footer();
echo $footer->getHTML();

