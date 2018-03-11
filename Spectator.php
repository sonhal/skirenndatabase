<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 10.03.2018
 * Time: 19.18
 */

namespace skirenndatabase;

require_once "Person.php";

class Spectator extends Person
{
    private $ticketType;
    private $eventID;

    public function __construct(string $name, int $phoneNr,string $address, string $ticketType, string $eventID)
    {
     parent::__construct($name, $phoneNr, $address);
     $this->ticketType = $ticketType;
     $this->eventID = $eventID;
    }

    /**
     * @return string
     */
    public function getTicketType(): string
    {
        return $this->ticketType;
    }

    /**
     * @return string
     */
    public function getEventID(): string
    {
        return $this->eventID;
    }



}