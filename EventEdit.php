<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 17.10
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";
require_once "IPostHandlingTemplateElement.php";
require_once "SkirennDBHandler.php";
require_once "SkirennRegistering.php";
require_once "RegistrerEvent.php";

class EventEdit extends RegistrerEvent implements ITemplateElement, IPostHandlingTemplateElement
{

    private $header = '<div class="w3-container w3-teal">
  <h2>Rediger Øvelse</h2>
</div>';
    protected $eventID;

    function handlePost()
    {
        if (isset($_POST["submit"])) {
            $this->eventID = $_POST["event"];
            $eventID = $_POST["event"];
            $date = $_POST["date"];
            $eventType = $_POST["type"];
            $location = $_POST["location"];

            $newEvent = new Event($eventType, $location, $date);

            $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $db->updateEvent($newEvent, $eventID);
            echo "Oppdatering fullført!";
            $db->close();

        }

        if (isset($_POST["edit"])) {
            $this->eventID = $_POST["event"];
        }

    }
    protected function getEventIdentityHTML(){
        $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
        $row = $db->getEvent($this->eventID);
        $db->close();


        $html= '<div class="w3-container w3-red">
  <h2>Du redigerer: ID : '. $row["id"] ." - ".$row["date"]." - ".$row["location"]." - ".$row["name"].'</h2>
</div>';
        return $html;
    }

    public function getHTML()
    {
        return $this->header . $this->getEventIdentityHTML() . $this->html . $this->getSelectEventTypeHTML() . '<input type="hidden" name="event" value="'. $this->eventID.'" />'.
            '<button class="w3-btn w3-blue-grey" name="submit">Register</button></form><br>';
    }
}