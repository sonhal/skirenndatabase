<?php
/**
 * Created by PhpStorm.
 * User: sondr
 * Date: 09.03.2018
 * Time: 15.19
 */

namespace skirenndatabase;


class safeDBConnector
{
    private $db;

    function __construct($dbHost, $dbUser, $dbPassword, $database)
    {

        $this->db = mysqli_connect($dbHost, $dbUser, $dbPassword, $database);
        $this->db->autocommit(false);
    }


    function getSafeDBConnection(){

        return $this->db;
    }

    function safeQuery($queryArray){
        $queryOk = true;
        foreach ($queryArray as $query){
            if(!$this->db->query($query)){
                $queryOk = false;
            }
            elseif ($this->db->affected_rows == 0){
                $queryOk = false;
            }
        }
        if($queryOk) { $this->db->commit(); echo "Innsetting OK"; }
        else { $this->db->rollback(); echo "Feil i innsettingen i databasen"; }
        return $queryOk;
    }
}