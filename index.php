<!DOCTYPE html>
<html  >
<head>
  <!-- Site made with Mobirise Website Builder v4.10.7, https://mobirise.com -->
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="generator" content="Mobirise v4.10.7, mobirise.com">
  <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1">
  <link rel="shortcut icon" href="../public/assets/images/favicon-39x39.png" type="image/x-icon">
  <meta name="description" content="Website Generator Description">
  
  <title>Index</title>
  
  
  
</head>
<body>

	<?php
	
	  require'util/const.php';
	  require'dao/DB.php';
	  require'controller/Controller.php';
	  require'controller/GeneratorController.php';
	  require 'model/FileGenerator.php';
		
		
	  $controller = new Controller();
	  foreach ($controller->getAll() as $c) {
		echo "<li>" . $c['firstname'] . "</li>";
	  }
	  
	  $generatorController=new GeneratorController();
	  $generatorController->generateBase('delivery','model/');
	?>
  
</body>
</html>