<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 10.03.2018
 * Time: 00.01
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "Page.php";
require_once "PageBuilder.php";
require_once "CustomerRegistration.php";

$header = new Header();
$footer = new Footer();
$body = new CustomerRegistration();
$page = new Page(new PageBuilder($header,$body, $footer ));

$body->handlePost();
$page->render();
