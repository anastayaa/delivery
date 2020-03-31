<?php

	interface ProductDAO{
	
		function getAllProducts();
		function getProductByDesignation($designation);
		function getProductById($id);
		
	}