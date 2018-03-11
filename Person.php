<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 11.03.2018
 * Time: 12.13
 */

namespace skirenndatabase;


class Person
{
    private $name;
    private $phoneNr;
    private $address;

    public function __construct(string $name, int $phoneNr, string $address)
    {
        $this->name = $name;
        $this->phoneNr = $phoneNr;
        $this->address = $address;
    }

    /**
     * @return string
     */
    public function getAddress(): string
    {
        return $this->address;
    }

    /**
     * @return int
     */
    public function getPhoneNr(): int
    {
        return $this->phoneNr;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

}