<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 14.25
 */

namespace skirenndatabase;


class Event
{
    private $eventType;
    private $location;
    private $date;


    public function __construct(int $eventType,string $location, string $date)
    {
        $this->eventType = $eventType;
        $this->date = $date;
        $this->location = $location;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getDate(): string
    {
        return $this->date;
    }

    /**
     * @return int
     */
    public function getEventType(): int
    {
        return $this->eventType;
    }

    /**
     * @return string
     */
    public function getLocation(): string
    {
        return $this->location;
    }
}