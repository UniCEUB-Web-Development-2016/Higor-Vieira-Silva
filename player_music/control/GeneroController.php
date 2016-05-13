<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 12/05/2016
 * Time: 17:55
 */

include_once "model/Request.php";
include_once "model/tb_genero.php";
include_once "database/DatabaseConnector.php";
class UserController
{
    public function register($request)
    {
        $params = $request->get_params();
        $user = new TbGenero(
            $params["nme_genero"]);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($user));
    }
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO tb_genero (nme_genero) VALUES ('".$user->getName()."','".
            $user->getNmeGenero()."')";

            return $query;
    }
    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");

        $conn = $db->getConnection();
        $result = $conn->query("SELECT nme_genero FROM tb_genero WHERE ".$crit);
        //foreach($result as $row)
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }
    private function generateCriteria($params)
    {
        $criteria = "";
        foreach($params as $key => $value)
        {
            $criteria = $criteria.$key." LIKE '%".$value."%' OR ";
        }
        return substr($criteria, 0, -4);
    }
}