<?php

namespace Estudante\Model ;

use Zend\Db\TableGateway\TableGateway ;
use Zend\Db\Adapter\Adapter ;
use Zend\Db\ResultSet\ResultSet ;

class EstudanteTable {
	
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway) {
		
		$this->tableGateway = $tableGateway ;
		
	}
	
	public function fetchAll() {

		$resultSet = $this->tableGateway->select();
		return $resultSet ;
		
	}
	
	public function getAluno($matricula) {
		
		$matricula = (int) $matricula ;
		$rowset = $this->tableGateway->select(array('matricula'=>$matricula));
		$row = $rowset->current() ;
		
		if (!$row) {
			throw new \Exception("Não encontrou matricula $matricula") ;
		}
		
		return $row;
		
	}
	
	public function saveEstudante(Estudante $estudante) {
		
		
		$data = array(
						'nome' => $estudante -> nome, 
				)	;
		
		$matricula = $estudante->matrica ;
		
		if(empty($matricula)) {
			
			$this->tableGateway->insert($data);
			
		} else {
			
			if ($this->getAluno($matricula)) {
				$this->tableGateway->update($data,array('matricula'=>$matricula));
			}
						
		}
		
	}
	
	public function deleteAluno($matricula) {

		$this->tableGateway->delete(array('matricula' => $matricula));
			
	}
	
	
}