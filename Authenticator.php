<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 13.04.2018
 * Time: 14.09
 */

namespace skirenndatabase;

require_once "SkirennDBHandler.php";

class Authenticator
{
    public function isAdmin($loginName, $password ){
        $db = new SkirennDBHandler("localhost", "root", "", "vm_ski");
        $result = $db->getAdmin($loginName);
        if($result){
            $db_hash = $result->fetch_assoc()["PASSWORD"];
            return password_verify($password, $db_hash);
        }

    }

}