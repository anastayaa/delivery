<?php 
	                class Product{
	                  		private $_id;
	                     	private $_designation;
	                     	private $_type;
	                     	
		                  	public function __construct(array $donnees){
		                    	$this->initialize($donnees);
		                    }
		                    public function getId(){
		                      return $this->_id;
		                    }
		                    public function getDesignation(){
		                      return $this->_designation;
		                    }
		                    public function getType(){
		                      return $this->_type;
		                    }
		                    public function setId($id){
		                      $this->_id=$id;
		                    }
		                    public function setDesignation($designation){
		                      $this->_designation=$designation;
		                    }
		                    public function setType($type){
		                      $this->_type=$type;
		                    }
		                  	public function initialize(array $donnees){
		                        foreach ($donnees as $cle => $valeur) {
		                           $fonction='set'.ucfirst($cle);
		                           if(method_exists($this,$fonction)){
		                              $this->$fonction($valeur);
		                           }
		                        }
		                    }
	                }