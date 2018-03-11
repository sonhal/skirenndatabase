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

    public function __construct(string $name, int $phoneNr, string $address, $nationality)
    {
        parent::__construct($name, $phoneNr, $address);
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }
}