<?php
	
	class CommandController{
		
		private $_commandDAO;
		
		public function __construct(){
			$this->_commandDAO=new CommandDAOImpl();
		}
		
		function addCommand($command){
			return $this->_commandDAO->addCommand($command);
		}
		
		function addProductCommand($productCommand){
			return $this->_commandDAO->addProductCommand($productCommand);
		}	
	}