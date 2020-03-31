<?php

	class ProductDAOImpl implements ProductDAO{
		
		private $_pdo;
		
		public function __construct(){
			$this->_pdo=DB::getInstance(DSN, USER, PASSWORD);
		}
		
		function getAllProducts(){
	   		$products = [];
	    	try{
	    		$stmt = $this->_pdo->query('SELECT * FROM products');
			    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
			    {
			      $products[] = new Product($row);
			    }
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    		$products = null;
	    	}
    		return $products;
	   	}
		
		function getProductByDesignation($designation){
			$product=null;
			try{
	    		$stmt =  $this->_pdo->prepare("SELECT * FROM products WHERE designation=:designation");
	    		$stmt->bindValue(':designation', $designation);
				$stmt->execute();
				$row = $stmt->fetch();
				if(is_array($row))
					$product=new Product($row);
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    	}
			return $product;
		}
		
		function getProductById($id){
			$product=null;
			try{
	    		$stmt =  $this->_pdo->prepare("SELECT * FROM products WHERE id=:id");
	    		$stmt->bindValue(':id', $id);
				$stmt->execute();
				$row = $stmt->fetch();
				if(is_array($row))
					$product=new Product($row);
	    	}
	    	catch(Exception $e){
	    		echo $e->getMessage();
	    	}
			return $product;
		}
	}