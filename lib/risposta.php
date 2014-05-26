<?php
abstract class TipoRisposta
{
    const Successo = 0;
    const Eccezione = 1;
}
class Risposta{
	public $tipo;
	public $contenuto;
	public $data;
	public function __construct($contenuto, $tipo = TipoRisposta::Successo,$data=null){
		$this->contenuto = $contenuto;
		$this->tipo = $tipo;
		$this->data = $data;
	}
}
?>
