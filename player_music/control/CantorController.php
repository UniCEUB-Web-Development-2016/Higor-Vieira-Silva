<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 12/05/2016
 * Time: 17:55
 */

include_once "model/Request.php";
include_once "model/tb_cantor.php";
include_once "database/DatabaseConnector.php";
class CantorController
{
    public function register($request)
    {
        $params = $request->get_params();
        $user = new TbCantor(
            $params["nme_cantor"],
            $params["sexo_cantor"],
            $params["cod_genero"]);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($user));
    }
    private function generateInsertQuery($user)
    {
        $query =  "INSERT INTO tb_cantor (nme_cantor, sexo_cantor, cod_genero ) VALUES ('".$user->getName()."','".
            $user->getNmeCantor()."','".
            $user->getSexoCantor()."','".
            $user->getCodGenero()."')";
        return $query;
    }
    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");

        $conn = $db->getConnection();
        $result = $conn->query("SELECT nme_cantor, sexo_cantor, cod_genero FROM tb_cantor WHERE ".$crit);
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
        if(!empty($params["idt_cantor"]) && !empty($params["nme_cantor"]) && !empty($params["sexo_cantor"])) {
            $name = addslashes(trim($params["nme_cantor"]));
            $sexo = addslashes(trim($params["sexo_cantor"]));
            $id = addslashes(trim($params["idt_cantor"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE bd_player_music.tb_cantor SET nme_cantor=:nme_cantor, sexo_cantor=:sexo_cantor WHERE idt_cantor=:idt_cantor");
            $result->bindValue(":nme_cantor", $name);
            $result->bindValue(":sexo_cantor", $sexo);
            $result->bindValue(":idt_cantor", $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "Cantor alterado com sucesso!";
            } else {
                echo "Cantor não atualizado";
            }
        }
    }
    public function delete($request)
    {
        $params = $request->get_params();
        if (!empty($params["idt_cantor"])){
            $id = addslashes(trim($params["idt_cantor"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_cantor WHERE idt_cantor = ?");
            $result->bindValue(1, $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "Cantor deletado com sucesso!";
            } else {
                echo "Cantor nÃ£o deletado";
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