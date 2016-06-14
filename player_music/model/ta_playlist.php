<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 31/05/2016
 * Time: 21:30
 */

class TaPlaylist {

    var $cod_usuario;
    var $cod_musica;


    public function __construct($cod_usuario, $cod_musica)
    {

        self::setCodUsuario($cod_usuario);
        self::setCodMusica($cod_musica);


    }


    public function getCodUsuario()
    {
        return $this->cod_usuario;

    }

    public function setCodUsuario($cod_usuario)
    {
        $this->cod_usuario = $cod_usuario;
    }

    public function getCodMusica()
    {
        return $this->cod_musica;
    }

    public function setCodMusica($cod_musica)
    {
        $this->cod_musica = $cod_musica;
    }

}