<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 12/05/2016
 * Time: 17:54
 */
include_once "model/Request.php";
include_once "model/tb_perfil.php";
include_once "database/DatabaseConnector.php";
class PerfilController
{
    public function register($request)
    {
        $params = $request->get_params();
        $user = new TbPerfil(
            $params["nme_perfil"]);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
        $conn = $db->getConnection();


        return $conn->query($this->generateInsertQuery($user));
    }

    private function generateInsertQuery($user)
    {
        $query = "INSERT INTO tb_perfil (nme_perfil) VALUES ('" . $user->getName() . "','" .
            $user->getNmePerfil() . "')";

        return $query;
    }

    public function search($request)
    {
        $params = $request->get_params();
        $crit = $this->generateCriteria($params);

        $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");

        $conn = $db->getConnection();
        $result = $conn->query("SELECT nme_perfil FROM bd_player_music.tb_perfil WHERE " . $crit);
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

        if (!empty($params["idt_perfil"]) && !empty($params["nme_perfil"])) {

            $name = addslashes(trim($params["nme_perfil"]));
            $id = addslashes(trim($params["idt_perfil"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE bd_player_music.tb_perfil SET nme_perfil=:nme_perfil WHERE idt_perfil=:idt_perfil");
            $result->bindValue(":nme_perfil", $name);
            $result->bindValue(":idt_perfil", $id);
            $result->execute();
            if ($result->rowCount() > 0) {
                echo "Perfil alterado com sucesso!";
            } else {
                echo "Perfil não atualizado";
            }
        }
    }

    public function delete($request)
    {
        $params = $request->get_params();
        if (!empty($params["idt_perfil"])) {
            $id = addslashes(trim($params["idt_perfil"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_perfil WHERE idt_perfil = id");
            $result->bindValue(":id", $id);
            $result->execute();
            if ($result->rowCount() > 0) {
                echo "Perfil deletado com sucesso!";
            } else {
                echo "Perfil nÃ£o deletado";
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