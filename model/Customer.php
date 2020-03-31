<?php 
	                class Customer{
	                  		private $_id;
	                     	private $_firstname;
	                     	private $_lastname;
	                     	private $_phone;
	                     	private $_email;
	                     	private $_street;
	                     	private $_city;
	                     	
		                  	public function __construct(array $donnees){
		                    	$this->initialize($donnees);
		                    }
		                    public function getId(){
		                      return $this->_id;
		                    }
		                    public function getFirstname(){
		                      return $this->_firstname;
		                    }
		                    public function getLastname(){
		                      return $this->_lastname;
		                    }
		                    public function getPhone(){
		                      return $this->_phone;
		                    }
		                    public function getEmail(){
		                      return $this->_email;
		                    }
		                    public function getStreet(){
		                      return $this->_street;
		                    }
		                    public function getCity(){
		                      return $this->_city;
		                    }
		                    public function setId($id){
		                      $this->_id=$id;
		                    }
		                    public function setFirstname($firstname){
		                      $this->_firstname=$firstname;
		                    }
		                    public function setLastname($lastname){
		                      $this->_lastname=$lastname;
		                    }
		                    public function setPhone($phone){
		                      $this->_phone=$phone;
		                    }
		                    public function setEmail($email){
		                      $this->_email=$email;
		                    }
		                    public function setStreet($street){
		                      $this->_street=$street;
		                    }
		                    public function setCity($city){
		                      $this->_city=$city;
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