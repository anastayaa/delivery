<?php

	class GeneratorController{
		
		private $instance;
		private $fileGenerator;
	
		public function __construct(){
	        $this->instance=DB::getInstance(DSN, USER, PASSWORD);		
		    $this->fileGenerator=new FileGenerator($this->instance);
	   	}
		
		function generateBase($db, $path){
			$this->fileGenerator->generateBase($db,$path);
		}
	}
