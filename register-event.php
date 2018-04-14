<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 14.43
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "Page.php";
require_once "PageBuilder.php";
require_once "CustomerRegistration.php";
require_once "RegistrerEvent.php";


$header = new Header();
$footer = new Footer();
$body = new RegistrerEvent();
$page = new Page(new PageBuilder($header,$body, $footer ));

$body->handlePost();
$page->render();
