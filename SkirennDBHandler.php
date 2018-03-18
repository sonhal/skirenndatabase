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

        $compid = $this->insertNewCompetitorSQL($personID, $competitor->getNationality());

        if ($compid != null){
            $result =$this->insertNewCompetitorEventConnectionSQL($competitor, $compid);
        }
        else{
            $this->db->rollback();
            return null;
        }

        $this->db->commit();
        return $result;
    }

    public function insertNewEvent(Event $event){
        $date = $event->getDate();
        $location = $event->getLocation();
        $eventID = $event->getEventType();

        if (!($stmt = $this->db->prepare("INSERT INTO event(DATE, LOCATION, EVENT_TYPE_ID) VALUES (?,?,?)"))) {
            echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
        }
        if (!$stmt->bind_param("ssd", $date, $location, $eventID)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed in Event: (" . $stmt->errno . ") " . $stmt->error;
        }
        else {
            $this->db->commit();
            return $stmt->insert_id;
        }
        return null;
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
            echo "Execute failed in Person: (" . $stmt->errno . ") " . $stmt->error;
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
            echo "Execute failed in Spectator: (" . $stmt->errno . ") " . $stmt->error;
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
            echo "Execute failed in Competitor: (" . $stmt->errno . ") " . $stmt->error;
        }
        else {
            return $stmt->insert_id;
        }
        return null;
    }

    private function insertNewCompetitorEventConnectionSQL(Competitor $competitor, $competitorID){
        $eventID = $competitor->getEventID();

        if (!($stmt = $this->db->prepare("INSERT INTO competitor_event(COMPETITORID, EVENTID) VALUES (?,?)"))) {
            echo "Prepare failed: (" . $this->db->errno . ") " . $this->db->error;
        }
        if (!$stmt->bind_param("ii",$competitorID, $eventID)) {
            echo "Binding parameters failed: (" . $stmt->errno . ") " . $stmt->error;
        }
        if (!$stmt->execute()) {
            echo "Execute failed in Competitor Event Connection: (" . $stmt->errno . ") " . $stmt->error;
        }
        else {
            return $stmt->insert_id;
        }
        return null;
    }



    public function getAllEvents(){
        $sql = "SELECT event.id, date, location, event.event_type_id, event_type.name FROM event, event_type where event.event_type_id = event_type.ID";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        else{
            throw new \InvalidArgumentException("Could not fetch from database");
        }
    }

    public function getEvent($eventID){
        $sql = "SELECT event.id, date, location, event.event_type_id, event_type.name FROM event, event_type where event.ID = ".$eventID." AND event.event_type_id = event_type.ID ";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row;
        }
        else{
            throw new \InvalidArgumentException("Could not fetch from database: eventId: - ". $eventID ." - ");
        }
    }

    public function getAllSpectators(){
        $sql = "SELECT person.name as PERSON_NAME, event.DATE, event.LOCATION, event_type.NAME as EVENT_TYPE from spectator, person, event, event_type WHERE spectator.PERSONID = person.id and spectator.EVENTID = event.ID AND event_type.ID = event.EVENT_TYPE_ID;";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        else{
            throw new \InvalidArgumentException("Could not fetch from database");
        }
    }

    public function deleteEvent($eventID){
        $sql = 'delete from event where id = '. $eventID;
        $result = $this->db->query($sql);

        if ($this->db->affected_rows > 0) {
            $this->db->commit();
            return true;
        }
        else{
            return false;
        }
    }

    public function getAllEventTypes(){
        $sql = "select * from event_type";
        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        else{
            throw new \InvalidArgumentException("Could not fetch from database");
        }
    }

    public function getAllCompetitorsForEvent($eventID){
        $sql = "SELECT competitor.NATIONALITY, person.NAME FROM competitor LEFT JOIN
 person on person.ID = competitor.PERSONID WHERE competitor.ID IN
  (SELECT competitor_event.COMPETITORID FROM competitor_event WHERE competitor_event.EVENTID = ".$eventID.");";

        $result = $this->db->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_all(MYSQLI_ASSOC);
            return $row;
        }
        else{
            return null;
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

    public function updateEvent(Event $event, $eventID){
        $sql = 'UPDATE event SET event.DATE = \''.$event->getDate().'\', event.LOCATION = \''.$event->getLocation().'\', event.EVENT_TYPE_ID = \''.$event->getEventType().'\' WHERE event.ID = '.$eventID;
        $result = $this->db->query($sql);
        $this->db->commit();
        return $result;


    }

    public function close(){
        $this->db->close();
    }

}