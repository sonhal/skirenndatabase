<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 18.03.2018
 * Time: 18.53
 */

$db = mysqli_connect("localhost", "root", "");
$sql = "CREATE DATABASE vm_ski";
mysqli_query($db, $sql);


$db = mysqli_connect("localhost", "root", "", "vm_ski");
$location = 'vm_ski.sql';

$commands = file_get_contents($location);
$db->multi_query($commands);

?>