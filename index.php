<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 18.27
 */

namespace skirenndatabase;

require_once "Header.php";
require_once "footer.php";
require_once "WelcomeBody.php";
require_once "PageBuilder.php";
require_once "Page.php";

$header = new Header();
$footer = new Footer();
$body = new WelcomeBody();
$pageBuilder = new PageBuilder($header, $body, $footer);
$page = new Page($pageBuilder);

$page->render();