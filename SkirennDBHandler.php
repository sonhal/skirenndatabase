<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 10.03.2018
 * Time: 19.59
 */

namespace skirenndatabase;

require_once "Competitor.php";

class SkirennDBHandler
{
    private $db;

    public function __construct($dbHost, $dbUser, $dbPassword, $database)
    {
        $this->db = mysqli_connect($dbHost, $dbUser, $dbPassword, $database);
        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        $this->db->autocommit(false);
        $this->db->set_charset("utf8");
    }

    public function insertNewSpectator(Spectator $spectator){
        $newPersonID = $this->insertNewPersonSQL($spectator->getName(), $spectator->getAddress(), $spectator->getPhoneNr());

        $result = $this->insertNewSpectatorSQL($spectator->getTicketType(), $newPersonID, $spectator->getEventID());

        $this->db->commit();
        return "Ye";
    }

    public function insertNewCompetitor(Competitor $competitor){
        $personID = $this->insertNewPersonSQl($competitor->getName(), $competitor->getAddress(), $competitor->getPhoneNr());

        $result = $this->insertNewCompetitorSQL($personID, $competitor->getNationality());

        $this->db->commit();
        return $result;
    }

    private function insertNewPersonSQl($name, $address, $phoneNr)
    {
        if (!($stmt = $this->db->prepare("INSERT INTO person(NAME,ADDRESS,PHONENR) VALUES (?,?,?)"))) {
            echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
        }
        if (!$stmt->bind_param("sss", $name, $address, $phoneNr)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        else {
            return $stmt->insert_id;
        }
        return null;
    }

    private function insertNewSpectatorSQL($ticketType, $personID, $eventID){
        if (!($stmt = $this->db->prepare("INSERT INTO spectator(TICKETID,PERSONID,EVENTID) VALUES (?,?,?)"))) {
            echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
        }
        if (!$stmt->bind_param("sii",$ticketType, $personID, $eventID)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        else {
            return $stmt->insert_id;
        }
        return null;

    }

    private function insertNewCompetitorSQL($personID, $nationality){
        if (!($stmt = $this->db->prepare("INSERT INTO competitor(PERSONID,NATIONALITY) VALUES (?,?)"))) {
            echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
        }
        if (!$stmt->bind_param("is",$personID, $nationality)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        else {
            return $stmt->insert_id;
        }
        return null;
    }

    public function getAllEvents(){
        $sql = "SELECT id, name FROM event_type";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        else{
            throw new \InvalidArgumentException("Could not fetch from database");
        }
    }

    public function getAllTicketTypes(){
        $sql = "SELECT id, name FROM ticket_type";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        else{
            throw new \InvalidArgumentException("Could not fetch from database");
        }
    }

    public function close(){
        $this->db->close();
    }

}