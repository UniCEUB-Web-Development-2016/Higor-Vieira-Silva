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
class MusicController
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

        $result = $conn->query("SELECT nme_musica, let_musica, cod_cantor, cod_genero FROM tb_musica WHERE ".$crit);

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

        if(!empty($params["idt_musica"]) && !empty($params["nme_musica"]) && !empty($params["let_musica"])) {

            $name = addslashes(trim($params["nme_musica"]));
            $sexo = addslashes(trim($params["let_musica"]));
            $id = addslashes(trim($params["idt_musica"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("UPDATE bd_player_music.tb_musica SET nme_musica=:nme_musica, let_musica=:let_musica WHERE idt_musica=:idt_musica");
            $result->bindValue(":nme_musica", $name);
            $result->bindValue(":let_musica", $sexo);
            $result->bindValue(":idt_musica", $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "Musica alterado com sucesso!";
            } else {
                echo "Musica não atualizado";
            }
        }
    }
    public function delete($request)
    {
        $params = $request->get_params();
        if (!empty($params["idt_musica"])){
            $id = addslashes(trim($params["idt_musica"]));

            $db = new DatabaseConnector("localhost", "bd_player_music", "mysql", "", "root", "");
            $conn = $db->getConnection();
            $result = $conn->prepare("DELETE FROM tb_musica WHERE idt_musica = id");
            $result->bindValue(":id", $id);
            $result->execute();
            if ($result->rowCount() > 0){
                echo "Musica deletado com sucesso!";
            } else {
                echo "Musica nÃ£o deletado";
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