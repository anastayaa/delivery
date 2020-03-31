<?php 
	                class Command{
	                  		private $_id;
	                     	private $_date;
	                     	private $_status;
	                     	private $_customer_id;
	                     	
		                  	public function __construct(array $donnees){
		                    	$this->initialize($donnees);
		                    }
		                    public function getId(){
		                      return $this->_id;
		                    }
		                    public function getDate(){
		                      return $this->_date;
		                    }
		                    public function getStatus(){
		                      return $this->_status;
		                    }
		                    public function getCustomer_id(){
		                      return $this->_customer_id;
		                    }
		                    public function setId($id){
		                      $this->_id=$id;
		                    }
		                    public function setDate($date){
		                      $this->_date=$date;
		                    }
		                    public function setStatus($status){
		                      $this->_status=$status;
		                    }
		                    public function setCustomer_id($customer_id){
		                      $this->_customer_id=$customer_id;
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