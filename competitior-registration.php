<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 12.03.2018
 * Time: 00.23
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "Page.php";
require_once "PageBuilder.php";
require_once "CompetitorRegistration.php";
require_once "Authenticator.php";

$header = new Header();
$footer = new Footer();
$body = new CompetitorRegistration();
$page = new Page(new PageBuilder($header,$body, $footer ));

$body->handlePost();
$page->render();



