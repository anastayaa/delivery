<?php
	
	session_start();	
	
	require'../util/const.php';
    require '../model/Customer.php';
    require'../dao/DB.php';
    require'../dao/CustomerDAO.php';
    require'../dao/CustomerDAOImpl.php';
    require'../controller/CustomerController.php';
	if(count($_POST)>0){	
		if(isset($_POST["firstname"]) && isset($_POST["lastname"])
			&& isset($_POST["phone"]) && isset($_POST["email"])
			&& isset($_POST["street"]) && isset($_POST["city"])){
			$customer=new Customer($_POST);
			$customerController=new CustomerController();
			$newCustomer=$customerController->addCustomer($customer);
			if($newCustomer!=null){
				$_SESSION["customer"]=serialize($newCustomer);
				header('location: page5.php');
			}
			else{
				?>
					<div class="alert alert-danger" role="alert">
						Erreur au niveau du serveur
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
				<?php
			}
		}
		else{
			?>
				<div class="alert alert-danger" role="alert">
					Merci de remplire tous les champs
					<button type="button" class="close" data-dismiss="alert" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
			<?php
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
  <section class="menu cid-rUh2MtWDHl" once="menu" id="menu1-f">

    


</section>


<section class="mbr-section form1 cid-rUoF2a2I5V" id="form1-g">

    

    
    <div class="container">
        <div class="row justify-content-center">
            <div class="title col-12 col-lg-8">
                <h2 class="mbr-section-title align-center pb-3 mbr-fonts-style display-2">
                    FORMULAIRE DE COMMANDE
                </h2>
                <h3 class="mbr-section-subtitle align-center mbr-light pb-3 mbr-fonts-style display-5">
                    Merci de remplir les informations personnelles suivantes :.
                </h3>
            </div>
        </div>
    </div>
    <div class="container">
        <div class="row justify-content-center">
            <div class="media-container-column col-lg-8">
                <!---Formbuilder Form--->
                <form action="#" method="POST" class="mbr-form form-with-styler" data-form-title="Form1">
                    <input type="hidden" name="email" data-form-email="true" value="">
                    <div class="row">
                        <div hidden="hidden" data-form-alert="" class="alert alert-success col-12">Merci de remplir toutes les informations!</div>
                        <div hidden="hidden" data-form-alert-danger="" class="alert alert-danger col-12">
                        </div>
                    </div>
                    <div class="dragArea row">
                        <div class="col-md-6  form-group" data-for="name">
                            <label for="name-form1-g" class="form-control-label mbr-fonts-style display-7">Nom</label>
                            <input type="text" name="firstname" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-g">
                        </div>
                        <div class="col-md-6  form-group" data-for="surname">
                            <label for="name-form1-g" class="form-control-label mbr-fonts-style display-7">Prénom</label>
                            <input type="text" name="lastname" data-form-field="Name" required="required" class="form-control display-7" id="name-form1-g">
                        </div>
                        <div class="col-md-6  form-group" data-for="email">
                            <label for="email-form1-g" class="form-control-label mbr-fonts-style display-7">Email</label>
                            <input type="email" name="email" data-form-field="Email" required="required" class="form-control display-7" id="email-form1-g">
                        </div>
                        <div data-for="phone" class="col-md-6  form-group">
                            <label for="phone-form1-g" class="form-control-label mbr-fonts-style display-7">Téléphone</label>
                            <input type="tel" name="phone" data-form-field="Phone" required="required" class="form-control display-7" id="phone-form1-g">
                        </div>
                        <div data-for="message" class="col-md-12 form-group">
                            <label for="message-form1-g" class="form-control-label mbr-fonts-style display-7">Adresse</label>
                            <textarea name="street" data-form-field="Message" required="required" class="form-control display-7" id="message-form1-g"></textarea>
                        </div>
                        <div data-for="country" class="col-md-12  form-group">
                            <label for="country-form1-g" class="form-control-label mbr-fonts-style display-7">Ville</label>
                            <select class="form-control" id="exampleFormControlSelect1" name="city">
                                <option>Rabat </option>
                                <option>Salé</option>
                                <option>Témara </option>
                                <option>Skhirat</option>
                                <option>Bouznika</option>
                                <option>Mohammadia</option>                                                                
                                <option>Casablanca</option>
                                <option>Dar Bouazza</option>
                                <option>Autre</option>                                
                            </select>
                        </div>
                        <div class="col-md-12 input-group-btn align-center">
                            <button type="submit" class="btn btn-primary btn-form display-4">Suivant</button>
                        </div>
                    </div>
                </form><!---Formbuilder Form--->
            </div>
        </div>
    </div>
</section>




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