<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 19.46
 */

namespace skirenndatabase;

require_once "ITemplateElement.php";
require_once "Authenticator.php";

class Header implements ITemplateElement
{

    private $header = '<header class="w3-bar w3-theme w3-xlarge" id="home"/>'.
    '<a class="w3-bar-item w3-button" href="/skirenndatabase/index.php"><i class="fa fa-database"></i></a>'.
    '<span class="w3-bar-item">Skirenn Database</span><a class="w3-bar-item w3-button" href="register-admin.php">Registrer admin</a><a class="w3-bar-item w3-button" href="admin-login.php">Logg inn</a></header></header>';

    private $loggedInHeader = '<header class="w3-bar w3-theme w3-xlarge" id="home"/>'.
    '<a class="w3-bar-item w3-button" href="/skirenndatabase/index.php"><i class="fa fa-database"></i></a>'.
    '<span class="w3-bar-item">Skirenn Database</span><a class="w3-bar-item w3-button" href="register-admin.php">Registrer admin</a><a class="w3-bar-item w3-button" href="logout.php">Logg ut</a></header>';


    public function getHTML()
    {
        session_start();
        $auth = new Authenticator();
        if($auth->isLoggedIn()){
            return $this->loggedInHeader;
        }
        else{
            return $this->header;
        }
    }

}