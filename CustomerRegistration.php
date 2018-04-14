<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 22.17
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";
require_once "IPostHandlingTemplateElement.php";
require_once "Spectator.php";
require_once "SafeDBConnector.php";
require_once "SkirennDBHandler.php";
require_once "SkirennRegistering.php";


class CustomerRegistration extends SkirennRegistering implements ITemplateElement, IPostHandlingTemplateElement
{

    private $html = ' <div class="w3-container w3-teal">
  <h2>Billett Registrering</h2>
</div>

<form class="w3-container" action="" method="post">
  <label class="w3-text-teal"><b>Navn</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="name">
  
  <label class="w3-text-teal"><b>Addresse</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="address">

  <label class="w3-text-teal"><b>Tlf</b></label>
  <input class="w3-input w3-border w3-light-grey" type="number" name="phonenr">
 
<br>'
  ;


    public function getHTML()
    {
        $this->html .= $this->getSelectTicketTypeHTML();
        $this->html .= $this->getSelectEventHTML();
        $this->html .= '<button class="w3-btn w3-blue-grey" name="submit">Register</button>
</form><br>';
        return $this->html;
    }

    function handlePost()
    {
        if (isset($_POST["submit"])) {
            $name = $_POST["name"];
            $phoneNr = $_POST["phonenr"];
            $address = $_POST["address"];
            $ticketType = $_POST["ticket_type"];
            $eventID = $_POST["event"];
            $spectator = new Spectator($name, $phoneNr, $address, $ticketType, $eventID);
            $_SESSION["spectator"] = serialize($spectator);

            $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $result = $db->insertNewSpectator($spectator);

            echo "Registrert";
        }
    }

    private function getSelectTicketTypeHTML(){
        $html = "<label class=\"w3-text-teal\"><b>Billett Type</b></label><select class='w3-select w3-border' name='ticket_type'>
  <option value='' disabled selected>Velg billett type...</option>";
        try {
            $skiDB = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $rows = $skiDB->getAllTicketTypes();
            $skiDB->close();
        }catch (\Exception $err){
            echo "ERROR";
            echo $err;
        }

        foreach ($rows as $row){
            $html .= "<option value='". htmlspecialchars($row["id"])."' >".htmlspecialchars($row["name"])."</option>";

        }
        $html .= "</select><br><br>";
        return $html;
    }


}