<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 16.53
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";
require_once "Head.php";

class PageBuilder implements ITemplateElement
{
    private $header, $body, $footer;

    private $docTop = '<!DOCTYPE html><html>';
    private $docBottom = '</html>';
    private $head;

    public function __construct(ITemplateElement $header, ITemplateElement $body, ITemplateElement $footer)
    {
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
        $this->head = new Head();
    }

    public function getHTML()
    {
        return $this->docTop . $this->head->getHtml() . $this->header->getHTML() . $this->body->getHTML() . $this->footer->getHTML() . $this->docBottom;
    }

}