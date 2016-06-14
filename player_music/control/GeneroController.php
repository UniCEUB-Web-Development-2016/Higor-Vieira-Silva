<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 12/05/2016
 * Time: 17:55
 */

include_once "model/Request.php";
include_once "model/tb_genero.php";
include_once "model/ta_playlist.php";
include_once "database/DatabaseConnector.php";
class GeneroController
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
        $query = "INSERT INTO tb_genero (nme_genero) VALUES ('" . $user->getName() . "','" .
            $user->getNmeGenero() . "')";

        return $query;
    }

    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");

        $conn = $db->getConnection();
        $result = $conn->query("SELECT nme_genero FROM tb_genero WHERE " . $crit);
        //foreach($result as $row)
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    private function generateCriteria($params)
    {
        $criteria = "";
        foreach ($params as $key => $value) {
            $criteria = $criteria . $key . " LIKE '%" . $value . "%' OR ";
        }
        return substr($criteria, 0, -4);
    }

    public function update($request)
    {
        $params = $request->get_params();

        if (!empty($params["idt_genero"]) && !empty($params["nme_genero"])) {

            $name = addslashes(trim($params["nme_genero"]));
            $id = addslashes(trim($params["idt_genero"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE bd_player_music.tb_genero SET nme_genero=:nme_genero WHERE idt_genero=:idt_genero");
            $result->bindValue(":nme_genero", $name);
            $result->bindValue(":idt_genero", $id);
            $result->execute();
            if ($result->rowCount() > 0) {
                echo "Genero alterado com sucesso!";
            } else {
                echo "Genero não atualizado";
            }
        }
    }

    public function delete($request)
    {
        $params = $request->get_params();
        if (!empty($params["idt_genero"])) {
            $id = addslashes(trim($params["idt_genero"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_genero WHERE idt_genero = id");
            $result->bindValue(":id", $id);
            $result->execute();
            if ($result->rowCount() > 0) {
                echo "genero deletado com sucesso!";
            } else {
                echo "genero nÃ£o deletado";
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