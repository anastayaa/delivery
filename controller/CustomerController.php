<?php
	
	class CustomerController{
		
		private $_customerDAO;
		
		public function __construct(){
			$this->_customerDAO=new CustomerDAOImpl();
		}
		
		function addCustomer($customer){
			return $this->_customerDAO->addCustomer($customer);
		}
	}