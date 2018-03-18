<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 15.42
 */

namespace skirenndatabase;

require_once "SkirennDBHandler.php";


class CustomerTicketList implements ITemplateElement
{
    private $header = '<div class="w3-container w3-teal">
  <h2>Tilskuer billett liste</h2>
</div>';
    private $db;
    public function __construct()
    {
       $this->db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
    }

    private function getCustomerTicketTableHTML(){
        $table = '<table class="w3-table w3-striped w3-border">'.
            '<tr><th>Navn</th><th>Dato</th><th>Sted</th><th>Øvelse</th></tr>';

        $rows = $this->db->getAllSpectators();
        if ($rows != null){
            foreach ($rows as $row){
                $table .= '<tr><td>'. $row["PERSON_NAME"] .'</td><td>'. $row["DATE"] .'</td><td>'. $row["LOCATION"] .'<td>'. $row["EVENT_TYPE"] .'</td></td></tr>';
            }
            $table .= '</table>';
            return $table;
        }
        else{
            return "<h3>Ingen har registrert seg som tilskuer</h3>";
        }
    }

    public function getHTML()
    {
        return $this->header . $this->getCustomerTicketTableHTML();
    }
}