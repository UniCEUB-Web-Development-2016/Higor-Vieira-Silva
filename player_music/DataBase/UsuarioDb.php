<?php
/**
 * Created by PhpStorm.
 * User: HigorVieira
 * Date: 05/05/2016
 * Time: 18:59
 */
include '../filtro/tb_usuario_filtro.php';
public class UsuarioDb{

    function Salvar($lista_usuario, $con){
        foreach (item as $lista_usuario){

        }


    }
    function Selecionar($filtro, $con){
        $filtro = new tb_usuario_filtro();
        $SQL = 'SELECT * FROM tb_usuario WHERE 1=1 ';
        if($filtro.getNmeUsuario().trim() != "" || $filtro.getNmeUsuario() != null){
            $SQL = $SQL."and nme_usuario = '".$filtro.getNmeUsuario()."''";
        }
    }

}


?>