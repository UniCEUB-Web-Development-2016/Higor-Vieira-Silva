<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 12/05/2016
 * Time: 17:54
 */

include_once "model/Request.php";
include_once "model/tb_musica.php";
include_once "database/DatabaseConnector.php";
class UserController
{
    public function register($request)
    {
        $params = $request->get_params();
        $user = new TbMusica(
            $params["nme_musica"],
            $params["let_musica"],
            $params["cod_cantor"],
            $params["cod_genero"]);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($user));
    }
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO tb_musica (nme_musica, let_musica, cod_cantor, cod_genero ) VALUES ('".$user->getName()."','".
            $user->getNmeMusica()."','".
            $user->getLetMusica()."','".
            $user->getCodCantor()."','".
            $user->getCodGenero()."')";
        return $query;
    }
    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");

        $conn = $db->getConnection();
        $result = $conn->query("SELECT nme_usuario, let_musica, cod_cantor, cod_genero FROM tb_musica WHERE ".$crit);
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