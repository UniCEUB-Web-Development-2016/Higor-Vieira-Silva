<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 10/05/2016
 * Time: 18:08
 */

include_once "model/Request.php";
include_once "control/UserController.php";
class ResourceController
{
    private $controlMap =
        [
            "tb_usuario" => "UserController",
            "tb_perfil" => "PerfilController",
            "tb_music" => "MusicController",
            "tb_cantor" => "CantorController",
            "tb_genero" => "GeneroController",
            "ta_playlist" => "PlaylistController",
        ];

    public function createResource($request)
    {
        return (new $this->controlMap[$request->get_resource()]())->register($request);
    }
    public function searchResource($request)
    {

        return (new $this->controlMap[$request->get_resource()]())->search($request);
    }
}