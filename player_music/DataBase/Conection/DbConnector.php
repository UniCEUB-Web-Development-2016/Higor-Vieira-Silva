<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 05/05/2016
 * Time: 18:37
 */
<?php



public class DBConnector{
    private $IP;
    private $name;
    private $type;
    private $port;
    private $user;
    private $pass;
    public function __construct($ip,$name,$type,$port,$user,$pass){
        $this->IP = $ip;
        $this->name = $name;
        $this->type = $type;
        $this->port = $port;
        $this->user = $user;
        $this->pass = $pass;
    }
    public function getConnection(){
        $dsn = $this->type.":dbname=".$this->name.";host=".$this->IP.";port=".$this->port;
        try{
            $connection = new PDO($dsn, $this->user, $this->pass);
            return $connection;
        }catch (PDOException $e) {
            echo 'Connection failed: ' . $e->getMessage();
        }
    }
}
?>
