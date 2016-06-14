<?php


class TbUsuario
{


    var $nme_usuario;
    var $senha_usuario;
    var $email_usuario;
    var $dta_nasc_usuario;
    var $sexo_usuario;
    var $cod_perfil;

    public function __construct($nme_usuario, $senha_usuario, $email_usuario, $dta_nasc_usuario, $sexo_usuario,$cod_perfil )
    {
        self::setNmeUsuario($nme_usuario);
        self::setSenhaUsuario($senha_usuario);
        self::setEmailUsuario($email_usuario);
        self::setDtaNascUsuario($dta_nasc_usuario);
        self::setSexoUsuario($sexo_usuario);
        self::setCodPerfil($cod_perfil);


    }


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

    function getEmailUsuario()
    {
        return $this->email_usuario;

    }


    function setEmailUsuario($email_usuario)
    {
        $this->email_usuario = $email_usuario;
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
}