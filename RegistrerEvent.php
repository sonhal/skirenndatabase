<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 14.02
 */

namespace skirenndatabase;

require_once "Event.php";
require_once "SkirennDBHandler.php";

class RegistrerEvent implements ITemplateElement, IPostHandlingTemplateElement
{
    protected $head = '<div class="w3-container w3-teal">
  <h2>Billett Registrering</h2>
</div>';

    protected $html = ' 

<form class="w3-container" action="" method="post">
  <label class="w3-text-teal"><b>Dato</b></label>
  <input class="w3-input w3-border w3-light-grey" type="date" name="date">
  
  <label class="w3-text-teal"><b>Sted</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text" name="location">
 
<br>';

    function handlePost()
    {
        if (isset($_POST["submit"])) {
            $date = $_POST["date"];
            $eventType = $_POST["type"];
            $location = $_POST["location"];

            $newEvent = new Event($eventType, $location, $date);

            $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $db->insertNewEvent($newEvent);

            echo "Registrert";
        }
    }

    protected function getSelectEventTypeHTML(){
        $html = "<label class=\"w3-text-teal\"><b>Event Type</b></label><select class='w3-select w3-border' name='type'>
  <option value='' disabled selected>Velg event type...</option>";
        try {
            $skiDB = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $rows = $skiDB->getAllEventTypes();
            $skiDB->close();
        }catch (\Exception $err){
            echo "ERROR";
            echo $err;
        }

        foreach ($rows as $row){
            $html .= "<option value='". htmlspecialchars($row["ID"])."' >".htmlspecialchars($row["NAME"])."</option>";

        }
        $html .= "</select><br><br>";
        return $html;
    }

    public function getHTML()
    {
        return $this->head . $this->html . $this->getSelectEventTypeHTML() .
            '<button class="w3-btn w3-blue-grey" name="submit">Register</button></form><br>';
    }
}