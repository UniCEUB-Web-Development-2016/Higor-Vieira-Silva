<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 10/05/2016
 * Time: 18:08
 */

include_once "model/Request.php";
include_once "control/UserController.php";
include_once "control/CantorController.php";
include_once "control/GeneroController.php";
include_once "control/MusicController.php";
include_once "control/PerfilController.php";
include_once "control/PlaylistController.php";

include_once "MusicController.php";
class ResourceController
{
    private $controlMap =
        [
            "tb_usuario" => "UserController",
            "tb_perfil" => "PerfilController",
            "tb_musica" => "MusicController",
            "tb_cantor" => "CantorController",
            "tb_genero" => "GeneroController",
            "ta_playlist" => "PlaylistController",
            "login" => "loginController",
        ];

    public function createResource($request)
    {
       (new $this->controlMap[$request->get_resource()]())->register($request);

    }
    public function searchResource($request)
    {

        return (new $this->controlMap[$request->get_resource()]())->search($request);
    }

    public function updateResource($request)
    {
        return (new $this->controlMap[strtolower($request->get_resource())]())->update($request);
    }

    public function deleteResource($request)
    {
        return (new $this->controlMap[strtolower($request->get_resource())]())->delete($request);
    }

}