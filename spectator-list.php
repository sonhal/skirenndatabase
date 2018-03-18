<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 16.06
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "Page.php";
require_once "PageBuilder.php";
require_once "CustomerRegistration.php";
require_once "CustomerTicketList.php";

$header = new Header();
$footer = new Footer();
$body = new CustomerTicketList();
$page = new Page(new PageBuilder($header,$body, $footer ));

$page->render();