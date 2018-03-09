<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 22.17
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";

class CustomerRegistration implements ITemplateElement
{

    private $html = ' <div class="w3-container w3-teal">
  <h2>Bilett Registrering</h2>
</div>

<form class="w3-container">
  <label class="w3-text-teal"><b>First Name</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text">

  <label class="w3-text-teal"><b>Last Name</b></label>
  <input class="w3-input w3-border w3-light-grey" type="text">

  <button class="w3-btn w3-blue-grey">Register</button>
</form>';

    public function getHTML()
    {
        return $this->html;
    }
}