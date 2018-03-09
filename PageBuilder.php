<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 16.53
 */

namespace skirenndatabase;


class PageBuilder implements ITemplateElement
{
    private $header, $body, $footer;

    private $docTop = '<!DOCTYPE html><html>';
    private $docBottom = '</html>';

    public function __construct(ITemplateElement $header, ITemplateElement $body, ITemplateElement $footer)
    {
        $this->header = $header;
        $this->body = $body;
        $this->footer = $footer;
    }

    public function getHTML()
    {
        return $this->docTop . $this->header->getHTML() . $this->body->getHTML() . $this->footer->getHTML() . $this->docBottom;
    }

}