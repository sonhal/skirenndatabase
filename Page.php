<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 18.04
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";

class Page implements IPage
{
    private $element;

    public function __construct(ITemplateElement $element)
    {
        $this->element = $element;
    }


    public function render()
    {
        echo $this->element->getHTML();
    }

}