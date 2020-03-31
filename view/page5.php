<?php
	session_start();
	
	
	require'../util/const.php';
    require '../model/Customer.php';
	require '../model/Product.php';
	require '../model/Command.php';
	require '../model/Product_command.php';
	require '../fpdf/fpdf.php';
	require '../fpdf/PDF.php';
	require'../dao/DB.php';
	require '../dao/ProductDAO.php';
	require '../dao/ProductDAOImpl.php';
	require '../dao/CommandDAO.php';
	require '../dao/CommandDAOImpl.php';
	require'../controller/ProductController.php';
	require'../controller/CommandController.php';
	require'../controller/PDFController.php';
	require '../PHPMailer/src/Exception.php';
	require '../PHPMailer/src/PHPMailer.php';
	require '../PHPMailer/src/SMTP.php';
	
	if(!isset($_SESSION["customer"])){
		header('location: page4.php');
	}
	else{
		$customer=unserialize($_SESSION["customer"]);
		$productController=new ProductController();
		$products=$productController->getAllProducts();
	}
	
	if(count($_POST)>0){	
		if(isset($_POST["command"])){
			$commandController=new CommandController();
			$commandData=array("status"=>"En cours", "customer_id"=>$customer->getId());
			$command=new Command($commandData);
			$newCommand=$commandController->addCommand($command);
			
			foreach($_POST as $p){
				$product=$productController->getProductByDesignation($p);
				if($product!=null){
					$productCommandData=array(
					"product_id"=>$product->getId(), "command_id"=>$newCommand->getId(), "quantity"=>1
					);
					$productCommand=new Product_command($productCommandData);
					$commandController->addProductCommand($productCommand);
				}
			}
			if($_POST["pv"]==="AVEC"){
				$product=$productController->getProductByDesignation("PAIN & VIENNOISERIE");
				$productCommandData=array(
				"product_id"=>$product->getId(), "command_id"=>$newCommand->getId(), "quantity"=>1
				);
				$productCommand=new Product_command($productCommandData);
				$commandController->addProductCommand($productCommand);
			}
			
			/*$pdf = new FPDF();
			$pdf->AddPage();
			$pdf->SetFont('Arial','B',16);
			$pdf->Cell(60,10,iconv('UTF-8', 'windows-1252', 'Détails de la commande'),1,0,'C');
			$pdf->Ln(20);
			$pdf->Cell(40,10,'Hello World!');
			$filename="../commands_pdf/test.pdf";
			$pdf->Output($filename,'F');*/
			$pdfController=new PDFController();
			$pdfController->generate($customer, $newCommand);
		}
	}

?>
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
  
  <title>commande</title>
  <link rel="stylesheet" href="../public/assets/web/assets/mobirise-icons-bold/mobirise-icons-bold.css">
  <link rel="stylesheet" href="../public/assets/web/assets/mobirise-icons/mobirise-icons.css">
  <link rel="stylesheet" href="../public/assets/tether/tether.min.css">
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap-grid.min.css">
  <link rel="stylesheet" href="../public/assets/bootstrap/css/bootstrap-reboot.min.css">
  <link rel="stylesheet" href="../public/assets/dropdown/css/style.css">
  <link rel="stylesheet" href="../public/assets/animatecss/animate.min.css">
  <link rel="stylesheet" href="../public/assets/theme/css/style.css">
  <link rel="stylesheet" href="../public/assets/mobirise/css/mbr-additional.css" type="text/css">
  
  
  
</head>
<body>
	<form action="#" method="POST" class="mbr-form form-with-styler" data-form-title="Form1">
  <section class="menu cid-rUh2MtWDHl" once="menu" id="menu1-f">

    


</section>


<section class="mbr-section form1 cid-rUoF2a2I5V" id="form1-g">

    

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    COMPOSEZ VOTRE PACK
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Merci de choisir les entrées :.
                </h3>
            </div>
        </div>
    </div>
	
	<div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">1 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="e1">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="E"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">2 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="e2">
										<?php
											foreach ($products as $product) {
												if($product->getType()=="E"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">3 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="e3">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="E"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">4 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="e4">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="E"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div> 
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">5 - </label>
                    <select class="form-control" id="exampleFormControlSelect1"name="e5">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="E"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">6 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1"name="e6">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="E"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">7 - </label>
                    <select class="form-control" id="exampleFormControlSelect1"name="e7">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="E"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">8 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="e8">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="E"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">9 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="e9">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="E"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>

        </div>
    </div>
	
</section>


<section class="mbr-section form1 cid-rUoF2a2I5V" id="form1-g">

    

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    COMPOSEZ VOTRE PACK
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Merci de choisir les plats :.
                </h3>
            </div>
        </div>
    </div>
	
	<div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">01 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="p1">
                      <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>                      
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">02 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="p2">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">03 - </label>
                    <select class="form-control" id="exampleFormControlSelect1"name="p3">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">04 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1"name="p4">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">05 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="p5">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">06 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="p6">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>

    

    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">07 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="p7">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">08 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1"name="p8">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">09 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="p9">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">10 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="p10">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div> 
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">11 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="p11">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">12 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1"name="p12">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">13 - </label>
                    <select class="form-control" id="exampleFormControlSelect1"name="p13">
                       <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">14 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="p14">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">15 - </label>
                    <select class="form-control" id="exampleFormControlSelect1"name="p15"> 
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">16 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="p16">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                    <label for="exampleFormControlSelect1">17 - </label>
                    <select class="form-control" id="exampleFormControlSelect1" name="p17">
                        <?php
							foreach ($products as $product) {
								if($product->getType()=="P"){
									echo utf8_encode("<option>".$product->getDesignation()."</option>");
								}
							}
						?>
                    </select>
                  </div>
            </div>
            <div class="media-container-column col-lg-4" data-form-type="formoid">
                <div class="form-group">
                                    <label for="exampleFormControlSelect1">18 - </label>
                                    <select class="form-control" id="exampleFormControlSelect1" name="p18">
                                        <?php
											foreach ($products as $product) {
												if($product->getType()=="P"){
													echo utf8_encode("<option>".$product->getDesignation()."</option>");
												}
											}
										?>
                                    </select>
                                  </div>
            </div>
        </div>
    </div>

</section>
<section class="mbr-section form1 cid-rUoF2a2I5V" id="form1-g">
	<div class="container">
	<div class="row justify-content-center">
		<div class="title col-12 col-lg-8">
			<h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
				PAIN & VIENNOISERIE
			</h2>
			<h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
				EN OPTION (300 Dhs de plus)
			</h3>
		</div>
	</div>
	<br>
	<div class="form-group">
		<label for="exampleFormControlSelect1"></label>
		<select class="form-control" id="exampleFormControlSelect1" name="pv">
			<option>SANS </option>
			<option>AVEC</option>
		</select>
	</div>
        
    </div>
	<div class="col-md-12 input-group-btn align-center">
		<button type="submit" class="btn btn-primary btn-form display-4" name="command">Valider Votre commande</button>
	</div>
</section>
</form>


  <script src="../public/assets/web/assets/jquery/jquery.min.js"></script>
  <script src="../public/assets/popper/popper.min.js"></script>
  <script src="../public/assets/tether/tether.min.js"></script>
  <script src="../public/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="../public/assets/dropdown/js/nav-dropdown.js"></script>
  <script src="../public/assets/dropdown/js/navbar-dropdown.js"></script>
  <script src="../public/assets/touchswipe/jquery.touch-swipe.min.js"></script>
  <script src="../public/assets/viewportchecker/jquery.viewportchecker.js"></script>
  <script src="../public/assets/mbr-switch-arrow/mbr-switch-arrow.js"></script>
  <script src="../public/assets/smoothscroll/smooth-scroll.js"></script>
  <script src="../public/assets/theme/js/script.js"></script>
  <script src="../public/assets/formoid/formoid.min.js"></script>
  
  
 <div id="scrollToTop" class="scrollToTop mbr-arrow-up"><a style="text-align: center;"><i class="mbr-arrow-up-icon mbr-arrow-up-icon-cm cm-icon cm-icon-smallarrow-up"></i></a></div>
    <input name="animation" type="hidden">
  </body>
</html>