<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 18.22
 */

namespace skirenndatabase;


class WelcomeBody implements ITemplateElement
{
    private $body = '<div class="w3-main w3-container"><h1 class="w3-jumbo">Weclome!</h1></div>';

    public function getHTML()
    {
        return $this->body;
    }
}