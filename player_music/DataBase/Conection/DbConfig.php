<?php

/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 05/05/2016
 * Time: 18:39
 */
include ('dbConnector.php');
public class DbConfig
{
var $IP = '127.0.0.1';
var $name = 'bd_player_music';
var $type = 'mysql';
var $port = '3306';
var $user = 'root';
var $pass = '';

function getConnection(){
    $con = new DBConnector($this->IP,$this->name,$this->type,$this->port,$this->user,$this->pass);
    return $con.getConnection();
}


}
?>