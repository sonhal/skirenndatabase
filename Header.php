<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 19.46
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";

class Header implements ITemplateElement
{

    private $header = '<header class="w3-bar w3-theme w3-xlarge" id="home"/>'.
    '<a class="w3-bar-item w3-button" href="#"><i class="fa fa-database"></i></a>'.
    '<span class="w3-bar-item">Skirenn Database</span></header>';


    public function getHTML()
    {
        return $this->header;
    }

}