<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 14.04.2018
 * Time: 20.51
 */

session_start();
unset($_SESSION["admin"]);
header('Location: '."index.php");