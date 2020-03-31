<?php 
	                class Product_command{
	                  		private $_id;
	                     	private $_product_id;
	                     	private $_command_id;
	                     	private $_quantity;
	                     	
		                  	public function __construct(array $donnees){
		                    	$this->initialize($donnees);
		                    }
		                    public function getId(){
		                      return $this->_id;
		                    }
		                    public function getProduct_id(){
		                      return $this->_product_id;
		                    }
		                    public function getCommand_id(){
		                      return $this->_command_id;
		                    }
		                    public function getQuantity(){
		                      return $this->_quantity;
		                    }
		                    public function setId($id){
		                      $this->_id=$id;
		                    }
		                    public function setProduct_id($product_id){
		                      $this->_product_id=$product_id;
		                    }
		                    public function setCommand_id($command_id){
		                      $this->_command_id=$command_id;
		                    }
		                    public function setQuantity($quantity){
		                      $this->_quantity=$quantity;
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