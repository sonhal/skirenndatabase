<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 11.03.2018
 * Time: 16.24
 */

namespace skirenndatabase;

require_once "SkirennDBHandler.php";

class EventList implements ITemplateElement, IPostHandlingTemplateElement
{
    private $header = '<div class="w3-container w3-teal">
  <h2>Øvelse liste</h2>
</div>';
    private $db;
    public function __construct()
    {
        $this->db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
    }

    private function createView(){
        $html = "";

        $num = 0;
        foreach ($this->db->getAllEvents() as $event){
            $html .= $this->getEventHTML($event, $num);
            $num++;
        }
        return $html;
    }

    private function getEventHTML($eventRow, $num){
        $competitorsHTML = $this->getEventCompetitorsHTML($eventRow["id"]);
        $html = "<h2>";
        $html .= '<button onclick=\'AcFunction("event'.$num.'")\' class="w3-button w3-left-align w3-card" style="width: 600px;">
'. $eventRow["date"] ." - ". $eventRow["name"]. " - ". $eventRow["location"].'
</button>

<div id="event'. $num .'" class="w3-container w3-hide">
'.$this->getCRUDButtons($eventRow["id"]). $competitorsHTML .'
</div>';
        return $html;
    }

    private function getEventCompetitorsHTML($eventID){
        $table = '<table class="w3-table w3-striped w3-border">'.
            '<tr><th>Nation</th><th>Name</th></tr>';

        $rows = $this->db->getAllCompetitorsForEvent($eventID);
        if ($rows != null){
            foreach ($rows as $row){
                $table .= '<tr><td>'. $row["NATIONALITY"] .'</td><td>'. $row["NAME"] .'</td></tr>';
            }
            $table .= '</table>';
            return $table;
        }
        else{
            return "<h3>Ingen utøvere er registrert til denne øvelsen</h3>";
        }


    }

    private function getScript(){
        return '<script>
function AcFunction(id) {
    var x = document.getElementById(id);
    if (x.className.indexOf("w3-show") == -1) {
        x.className += " w3-show";
    } else {
        x.className = x.className.replace(" w3-show", "");
    }
}
</script>';
    }

    private function getCRUDButtons($eventID){
        $html = '<div class="row">';
        $html .= '<div class="w3-col s2 w3-center">';
        $html .= $this->getDeleteEventHTML($eventID);
        $html .= '</div>';
        $html .= '<div class="w3-col s2 w3-center">';
        $html .= $this->getEditEventHTML($eventID);
        $html .= '</div><div class="w3-col s8 w3-center"></div></div>';
        return $html;
    }

    private function getDeleteEventHTML($eventID){
        $html = '<form class="w3-container" action="" method="post"><input type="hidden" value="'.$eventID.'" name="event"><button class="w3-btn w3-red" name="delete">Slett</button></form>';
        return $html;
    }

    private function getEditEventHTML($eventID){
        $html = '<form class="w3-container" action="edit-event.php" method="post"><input type="hidden" value="'.$eventID.'" name="event"><button class="w3-btn w3-green" name="edit">Endre</button></form>';
        return $html;
    }

    public function getHTML()
    {
        return $this->header . $this->getScript() . $this->createView() ."<br><br>";
    }

    function handlePost()
    {
        if (isset($_POST["delete"])) {
            $eventID = $_POST["event"];

            $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            if($db->deleteEvent($eventID)){
                echo "Øvelse Slettet";
            }
            else {
                echo "Kunne ikke slette øvelse";
            }


            echo "Registrert";
        }
    }
}