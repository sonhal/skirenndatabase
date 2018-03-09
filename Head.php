<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 15.17
 */



namespace skirenndatabase;

require_once "ITemplateElement.php";

class Head implements ITemplateElement
{


    private $headerString = '<meta name="viewport" content="width=device-width, initial-scale=1.0">'.
'<meta charset="UTF-8"><meta name="description" content="Free Web tutorials">'.
    '<meta name="keywords" content="webprogrammering oblig 2">'.
    '<meta name="author" content="s305349">'.
    '<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">'.
    '<link rel="stylesheet" href="https://www.w3schools.com/lib/w3-theme-teal.css">'.
    '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">'.
    '<link rel="stylesheet" href="/maincss.css">';


    public function getHtml(){
    return $this->headerString;
}

}