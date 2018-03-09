<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 16.40
 */

namespace skirenndatabase;


class SafeDBConnector
{
    private $db;

    function __construct($dbHost, $dbUser, $dbPassword, $database)
    {

        $this->db = mysqli_connect($dbHost, $dbUser, $dbPassword, $database);
        $this->db->autocommit(false);
    }


    function getDB(){
        return $this->db;
    }

    function query($query){
        return $this->db->query($query);
    }

    function safeInsertQuery($queryArray){
        $queryOk = true;
        foreach ($queryArray as $query){
            $response = $this->db->query($query);

            if(!$response){ $queryOk = false;}
            elseif ($this->db->affected_rows == 0){$queryOk = false;}
        }
        if($queryOk) { $this->db->commit(); echo "InsertionCompleted"; }
        else { $this->db->rollback(); echo "Error in DB Insertion, rollback"; }
        return $queryOk;
    }
}