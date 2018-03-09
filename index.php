<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 18.27
 */

namespace skirenndatabase;

require_once "header.php";

$header = new header();
$footer = new Footer();
$body = new WelcomeBody();
$pageBuilder = new PageBuilder($header, $body, $footer);
$page = new Page($pageBuilder);

$page->render();