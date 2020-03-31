<?php

	class CommandDAOImpl implements CommandDAO{
		
		private $_pdo;
		
		public function __construct(){
			$this->_pdo=DB::getInstance(DSN, USER, PASSWORD);
		}
		
		function addCommand($command){
			if(!is_null($command)){
	    		try{
	    			$this->_pdo->beginTransaction();
		    		$stmt =  $this->_pdo->prepare("INSERT INTO commands 
					(status, customer_id)
					VALUES (:status, :customer_id)");
		    		$stmt->bindValue(':status', $command->getStatus());
					$stmt->bindValue(':customer_id', $command->getCustomer_id());
		    		$stmt->execute();
					$id=$this->_pdo->lastInsertId();
					$newCommand=$this->getCommandById($id);
			    	$this->_pdo->commit();
	    		}
	    		catch(PDOException $e){
	    			$this->_pdo->rollback();
		    		echo $e->getMessage();
		    		$newCommand=null;
	    		}
	    		return $newCommand;
	    	}
		}
		
		function getCommandById($id){
			try{
	    		$stmt =  $this->_pdo->prepare("SELECT * FROM commands WHERE id=:id");
	    		$stmt->bindValue(':id', $id);
				$stmt->execute();
				$row = $stmt->fetch();
				if(is_array($row))
					$command=new Command($row);
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    		$command=null;
	    	}
			return $command;
		}
		
		function addProductCommand($productCommand){
			if(!is_null($productCommand)){
	    		try{
	    			$this->_pdo->beginTransaction();
					$pc=$this->getProductCommandByProductAndCommandId(
					        $productCommand->getProduct_id(), $productCommand->getCommand_id());
					if($pc!=null){
						$stmt =  $this->_pdo->prepare("UPDATE products_commands SET quantity=quantity+1 
						WHERE product_id=:product_id");
						$stmt->bindValue(':product_id', $productCommand->getProduct_id());
						$stmt->execute();
					}
					else{
						$stmt =  $this->_pdo->prepare("INSERT INTO products_commands 
						(product_id, command_id, quantity)
						VALUES (:product_id, :command_id, :quantity)");
						$stmt->bindValue(':product_id', $productCommand->getProduct_id());
						$stmt->bindValue(':command_id', $productCommand->getCommand_id());
						$stmt->bindValue(':quantity', $productCommand->getQuantity());
						$stmt->execute();
					}
			    	$this->_pdo->commit();
	    		}
	    		catch(PDOException $e){
	    			$this->_pdo->rollback();
		    		echo $e->getMessage();
		    		return null;
	    		}
	    		return $productCommand;
	    	}
		}	
		
		function getProductCommandByProductAndCommandId($product_id, $command_id){
	    	$productCommand=null;
			try{
	    		$stmt =  $this->_pdo->prepare("SELECT * FROM products_commands WHERE 
				product_id=:product_id AND command_id=:command_id");
	    		$stmt->bindValue(':product_id', $product_id);
				$stmt->bindValue(':command_id', $command_id);
				$stmt->execute();
				$row = $stmt->fetch();
				if(is_array($row))
					$productCommand=new Product_Command($row);
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    	}
			return $productCommand;
		}
		
		function getAllProductsCommandsByCommandId($command_id){
	   		$products_commands = [];
	    	try{
	    		$stmt = $this->_pdo->prepare('SELECT * FROM products_commands WHERE command_id=:command_id');
				$stmt->bindValue(':command_id', $command_id);
				$stmt->execute();
			    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			    {
			      $products_commands[] = new Product_command($row);
			    }
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    	}
    		return $products_commands;
	   	}
	}