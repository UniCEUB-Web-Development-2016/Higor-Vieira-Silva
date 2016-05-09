<?php


class TbCantor{


	var $nme_cantor;
	var $sexo_cantor;
	var $cod_genero;

	public function__construct($nme_cantor, $sexo_cantor, cod_genero){

	}

    	public function getNmeCantor(){
    		return $this->nme_cantor;

    }

    	public function setNmeCantor($nme_cantor){
    		$this->nme_cantor = $nme_cantor;
    }
    
       public function getSexoCantor(){
               return $this->sexo_cantor;

        }

           public function setSexoCantor($sexo_cantor){
            		$this->sexo_cantor = $sexo_cantor;
    }

   	 public function getCodGenero(){
                   return $this->cod_genero;

            }

        public function setCodGenero($cod_genero){
                		$this->cod_genero = $cod_genero;