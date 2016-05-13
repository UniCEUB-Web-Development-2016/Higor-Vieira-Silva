<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 10/05/2016
 * Time: 18:16
 */

include_once "model/Request.php";
include_once "model/tb_usuario.php";
include_once "database/DatabaseConnector.php";
class UserController
{
    public function register($request)
    {
        $params = $request->get_params();
        $user = new TbUsuario(
            $params["nme_usuario"],
            $params["senha_usuario"],
            $params["dta_nasc_usuario"],
            $params["sexo_usuario"],
            $params["cod_perfil"]);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($user));
    }
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO tb_usuario (nme_usuario, senha_usuario, dta_nasc_usuario, sexo_usuario, cod_perfil ) VALUES ('".$user->getName()."','".
            $user->getNmeUsuario()."','".
            $user->getSenhaUsuario()."','".
            $user->getDtaNascUsuario()."','".
            $user->getSexoUsuario()."','".
            $user->getCodPerfil()."')";
        return $query;
    }
    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");

        $conn = $db->getConnection();
        $result = $conn->query("SELECT nme_usuario, senha_usuario, dta_nasc_usuario, sexo_usuario, cod_perfil FROM tb_usuario WHERE ".$crit);
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