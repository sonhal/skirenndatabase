<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 11.03.2018
 * Time: 12.17
 */

namespace skirenndatabase;

require_once "Person.php";

class Competitor extends Person
{
    private $nationality;
    private $eventID;

    public function __construct(string $name, int $phoneNr, string $address, $nationality, $eventID)
    {
        parent::__construct($name, $phoneNr, $address);
        $this->nationality = $nationality;
        $this->eventID = $eventID;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @return mixed
     */public function getEventID()
{
    return $this->eventID;
}
}