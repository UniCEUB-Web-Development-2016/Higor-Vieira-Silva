<?php

class TbMusica{

	var $nome
	var $letra
	var $cod_genero
	var $cod_cantor


	public function__construct($nome, $letra, $cod_genero, $cod_cantor){
	self::setNome($nome);	
	self::setLetra$letra);
	self::setCodGenero($cod_genero);
	self::setCodCantor($cod_cantor);

	

}

	public function getNome(){
		return $this->nome;

}

	public function setNome($nome){
		$this->nome = $nome;
}

	public function getLetra(){
		return $this->letra
}

	public function setLetra($letra){
		$this->letra = $letra;
}
	
	public function getCodGenero(){
		return $this->cod_genero

}
	public function setCodGenero($cod_genero){
		$this->cod_genero = $cod_genero;
}

	public function getCodCantor(){
		return $this->cod_cantor
}

	public function setCodCantor($cod_cantor){
		$this->cod_cantor = $cod_cantor;
}