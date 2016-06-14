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
            $params["email_usuario"],
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

        $query =  "INSERT INTO tb_usuario (nme_usuario, senha_usuario, email_usuario, dta_nasc_usuario, sexo_usuario, cod_perfil ) VALUES ('".
            $user->getNmeUsuario()."','".
            $user->getSenhaUsuario()."','".
            $user->getEmailUsuario()."','".
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
        $result = $conn->query("SELECT nme_usuario, senha_usuario, email_usuario, dta_nasc_usuario, sexo_usuario, cod_perfil FROM bd_player_music.tb_usuario WHERE ".$crit);
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

    public function update($request)
    {
        $params = $request->get_params();

        if(!empty($params["idt_usuario"]) && !empty($params["nme_usuario"]) && !empty($params["email_usuario"]) && !empty($params["senha_usuario"])  && !empty($params["dta_nasc_usuario"]) && !empty($params["sexo_usuario"])) {

            $name = addslashes(trim($params["nme_usuario"]));
            $email = addslashes(trim($params["email_usuario"]));
            $senha = addslashes(trim($params["senha_usuario"]));
            $dta_nasc = addslashes(trim($params["dta_nasc_usuario"]));
            $sexo = addslashes(trim($params["sexo_usuario"]));
            $id = addslashes(trim($params["idt_usuario"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE bd_player_music.tb_usuario SET nme_usuario=:nme_usuario, email_usuario=:email_usuario, senha_usuario=:senha_usuario, dta_nasc_usuario=:dta_nasc_usuario, sexo_usuario=:sexo_usuario WHERE idt_usuario=:idt_usuario");
            $result->bindValue(":nme_usuario", $name);
            $result->bindValue(":email_usuario", $email);
            $result->bindValue(":senha_usuario", $senha);
            $result->bindValue(":dta_nasc_usuario", $dta_nasc);
            $result->bindValue(":sexo_usuario", $sexo);
            $result->bindValue(":idt_usuario", $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "Usuário alterado com sucesso!";
            } else {
                echo "Usuário não atualizado";
            }
        }
    }
    public function delete($request)
    {
        $params = $request->get_params();
var_dump($params);
        if (!empty($params["idt_usuario"])){
            $id = addslashes(trim($params["idt_usuario"]));

           $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM bd_player_music.tb_usuario WHERE idt_usuario=:idt_usuario");
            $result->bindValue(":idt_usuario", $id);
            $result->execute();
            var_dump($result);
            if ($result->rowCount() > 0){
                echo "Usuario deletado com sucesso!";
            } else {
                echo "Usuario não deletado";
            }
        }
    }
    private function isValid($parameters)
    {
        $keys = array_keys($parameters);
        $diff1 = array_diff($keys, $this->requiredParameters);
        $diff2 = array_diff($this->requiredParameters, $keys);
        if (empty($diff2) && empty($diff1))
            return true;
        return false;
    }
}