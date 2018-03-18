<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 17.31
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "Page.php";
require_once "PageBuilder.php";
require_once "CustomerRegistration.php";
require_once "EventEdit.php";

$header = new Header();
$footer = new Footer();
$body = new EventEdit();
$page = new Page(new PageBuilder($header,$body, $footer ));

$body->handlePost();
$page->render();