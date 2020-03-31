<?php
	
	class ProductController{
		
		private $_productDAO;
		
		public function __construct(){
			$this->_productDAO=new ProductDAOImpl();
		}
		
		function getAllProducts(){
			return $this->_productDAO->getAllProducts();
		}
		
		function getProductByDesignation($designation){
			return $this->_productDAO->getProductByDesignation($designation);
		}
	}