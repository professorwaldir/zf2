<?php

namespace Estudante\Model;

class Estudante {
	
		public $matrica;
		public $nome;
		
		public function exchangeArray($data) {
			
				$this->$matricula = (isset($data['matricula'])) ? $data['matricula'] : null ;
				$this->$nome      = (isset($data['nome']))      ? $data['nome']      : null ;
							
		}
}