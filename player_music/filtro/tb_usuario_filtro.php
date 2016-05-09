<?php

/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 05/05/2016
 * Time: 19:05
 */
public class tb_usuario_filtro
{


    var $nme_usuario;
    var $senha_usuario;
    var $dta_nasc_usuario;
    var $sexo_usuario;
    var $cod_perfil;



    function getNmeUsuario()
    {
        return $this->nme_usuario;

    }


    function setNmeUsuario($nme_usuario)
    {
        $this->nme_usuario = $nme_usuario;
    }


    function getSenhaUsuario()
    {
        return $this->senha_usuario;

    }


    function setSenhaUsuario($senha_usuario)
    {
        $this->senha_usuario = $senha_usuario;
    }


    function getDtaNascUsuario()
    {
        return $this->dta_nasc_usuario;

    }


    function setDtaNascUsuario($dta_nasc_usuario)
    {
        $this->dta_nasc_usuario = $dta_nasc_usuario;

    }


    function getSexoUsuario()
    {
        return $this->sexo_usuario;

    }

    function setSexoUsuario($sexo_usuario)
    {
        $this->sexo_usuario = $sexo_usuario;
    }

    function getCodPerfil()
    {
        return $this->cod_perfil;

    }

    function setCodPerfil($cod_perfil)
    {
        $this->cod_perfil = $cod_perfil;
    }
