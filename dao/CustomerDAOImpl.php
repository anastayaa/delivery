<?php

	class CustomerDAOImpl implements CustomerDAO{
		
		private $_pdo;
		
		public function __construct(){
			$this->_pdo=DB::getInstance(DSN, USER, PASSWORD);
		}
		
		function addCustomer($customer){
			if(!is_null($customer)){
	    		try{
	    			$this->_pdo->beginTransaction();
		    		$stmt =  $this->_pdo->prepare("INSERT INTO customers 
					(firstname, lastname, phone, email, street, city)
					VALUES (:firstname, :lastname, :phone, :email, :street, :city)");
		    		$stmt->bindValue(':firstname', $customer->getFirstname());
					$stmt->bindValue(':lastname', $customer->getLastname());
					$stmt->bindValue(':phone', $customer->getPhone());
					$stmt->bindValue(':email', $customer->getEmail());
					$stmt->bindValue(':street', $customer->getStreet());
					$stmt->bindValue(':city', $customer->getCity());
		    		$stmt->execute();
					$id=$this->_pdo->lastInsertId();
					$newCustomer=$this->getCustomerById($id);
			    	$this->_pdo->commit();
	    		}
	    		catch(PDOException $e){
	    			$this->_pdo->rollback();
		    		echo $e->getMessage();
		    		$newCustomer=null;
	    		}
	    		return $newCustomer;
	    	}
		}
		
		function getCustomerById($id){
			try{
	    		$stmt =  $this->_pdo->prepare("SELECT * FROM customers WHERE id=:id");
	    		$stmt->bindValue(':id', $id);
				$stmt->execute();
				$row = $stmt->fetch();
				if(is_array($row))
					$customer=new Customer($row);
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    		$customer=null;
	    	}
			return $customer;
		}
	}