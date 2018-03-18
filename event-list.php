<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 17.03.2018
 * Time: 23.41
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "Page.php";
require_once "PageBuilder.php";
require_once "CustomerRegistration.php";
require_once "EventList.php";

$header = new Header();
$footer = new Footer();
$body = new EventList();
$page = new Page(new PageBuilder($header,$body, $footer ));

$body->handlePost();
$page->render();