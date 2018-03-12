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
    private $body = '<div class="w3-main w3-container">
<h1 class="w3-jumbo">Velkommen!</h1>
</div>';

    private $registerSpectatorCard = '<a href="customer-registration.php" style="text-decoration: none;"><div class="w3-card w3-hover-shadow" style="padding:10px; margin: 20px;">
<header class="w3-container w3-blue">
  <h1>Registrer deg som tilskuer</h1>
</header>

<div class="w3-container">
  <p>Klikk her</p>
</div>
</div></a>';

    private $registerCompetitorCard = '<a href="competitior-registration.php" style="text-decoration: none;"><div class="w3-card w3-hover-shadow" style="padding:10px; margin: 20px;">
<header class="w3-container w3-blue">
  <h1>Registrer deg som utøver</h1>
</header>

<div class="w3-container">
  <p>Klikk her</p>
</div>
</div></a>';

    public function getHTML()
    {
        $this->body .= $this->getRegistrationMenu();
        return $this->body;
    }

    private function getRegistrationMenu(){
        $html = '<div class="w3-row">';
        $html .= '<div class="w3-col m1"> </div>';
        $html .= '<div class="w3-col s12 m6 w3-center">' . $this->registerSpectatorCard . '</div>';
        $html .= '<div class="w3-col m2"> </div>';
        $html .= '<div class="w3-col s12 m6 w3-center">' . $this->registerCompetitorCard . '</div>';
        $html .= '<div class="w3-col m1"> </div>';
        $html .= '</div>';
        return $html;

    }
}