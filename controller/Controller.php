<?php

	class Controller{
		
		private $instance;
	
		public function __construct(){
	        $this->instance=DB::getInstance(DSN, USER, PASSWORD);
	   	}
		
		function getAll(){
			$rows=$this->instance->query('SELECT * from customers');
			return $rows;
		}
	}
