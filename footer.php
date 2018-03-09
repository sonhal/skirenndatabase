<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 15.18
 */

namespace skirenndatabase;


class Footer implements ITemplateElement
{
    private $footer = '<footer class="w3-container w3-theme"><p>Footer</p></footer>';

    public function getHTML()
    {
        return $this->footer;
    }
}