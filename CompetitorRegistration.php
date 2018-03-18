<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 12.03.2018
 * Time: 00.10
 */

namespace skirenndatabase;

require_once "SkirennDBHandler.php";
require_once "SkirennRegistering.php";
require_once "ITemplateElement.php";
require_once "IPostHandlingTemplateElement.php";

class CompetitorRegistration extends SkirennRegistering implements ITemplateElement, IPostHandlingTemplateElement
{
    private $form = ' <div class="w3-container w3-teal">
  <h2>Utøver Registrering</h2>
</div>

<form class="w3-container" action="" method="post">
  <label class="w3-text-teal"><b>Navn</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="name">
  
  <label class="w3-text-teal"><b>Addresse</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="address">

  <label class="w3-text-teal"><b>Tlf</b></label>
  <input class="w3-input w3-border w3-light-grey" type="number" name="phonenr">
<br>';

    private function getSelectNationalityHTML(){
        $html = '<label class="w3-text-teal"><b>Nasjonalitet</b></label><select class="w3-select w3-border" name="nationality">
  <option value="" disabled selected>Velg Nasjonalitet...</option>
  <option value="Norway">Norge</option>
  <option value="Sweden">Sverige</option>
  <option value="Denmark">Danmark</option></select><br><br>';
        return $html;
    }

    function handlePost()
    {
        session_start();

        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $phoneNr = $_POST["phonenr"];
            $address = $_POST["address"];
            $nationality = $_POST["nationality"];
            $eventID = $_POST["event"];
            $competitor = new Competitor($name, $phoneNr, $address, $nationality, $eventID);

            $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $result = $db->insertNewCompetitor($competitor);

            echo "Registrert";
        }
    }

    public function getHTML()
    {
        $this->form .= $this->getSelectEventHTML() . $this->getSelectNationalityHTML() .
            '<button class="w3-btn w3-blue-grey" name="submit">Register</button></form><br>';
        return $this->form;
    }
}