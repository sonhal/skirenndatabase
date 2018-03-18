<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 11.03.2018
 * Time: 14.23
 */

namespace skirenndatabase;

require_once "SkirennDBHandler.php";

class SkirennRegistering
{

    protected function getSelectEventHTML(){
        $html = "<label class=\"w3-text-teal\"><b>Øvelse</b></label><select class='w3-select w3-border' name='event'>
  <option value='' disabled selected>Velg øvelse...</option>";
        try {
            $skiDB = new SkirennDBHandler("localhost", "root", "", "vm_ski");
            $rows = $skiDB->getAllEvents();
            $skiDB->close();
        }catch (\Exception $err){
            echo "ERROR";
            echo $err;
        }

        foreach ($rows as $row){
            $html .= "<option value='". htmlspecialchars($row["id"])."' >".
                htmlspecialchars($row["date"])." - ". htmlspecialchars($row["name"]). " - " .htmlspecialchars($row["location"]).
                "</option>";

        }
        $html .= "</select><br><br>";
        return $html;
    }

}