<?php


class TbGenero{


	var $nme_genero;
		

	public function __construct($nme_genero)
	{
		self::setNmeGenero($nme_genero);

	}


	public function getNmeGenero(){
		return $this->nme_genero;

}

	public function setNmeGenero($nme_genero){
		$this->nme_genero = $nme_genero;

}

}