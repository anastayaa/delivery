<?php

	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
	
	class PDFController{
		
		private $_pdf;
		private $_commandDAO;
		private $_productDAO;
		
		public function __construct(){
			$this->_pdf=new PDF();
			$this->_commandDAO=new CommandDAOImpl();
			$this->_productDAO=new ProductDAOImpl();
		}
		
		function generate($customer, $command){
			$this->_pdf->setCommand_no($command->getId());
			$total=1200;
			$this->_pdf->AliasNbPages();
			$this->_pdf->AddPage();
			$this->_pdf->SetFont('Arial','B',11);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Information du client'),0,1);
			$this->_pdf->Ln();
			$this->_pdf->SetFont('Times','',11);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Nom: '.$customer->getFirstname().' '.$customer->getLastname()),0,1);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Tél: '.$customer->getPhone()),0,1);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Email: '.$customer->getEmail()),0,1);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Adtesse: '.$customer->getStreet().', '.$customer->getCity()),0,1);
			$this->_pdf->Ln();
			$this->_pdf->SetFont('Arial','B',11);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Information de la commande'),0,1);
			$this->_pdf->Ln();
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Pack 1: les entrées'),0,1);
			$this->_pdf->Ln();
			$this->_pdf->SetFont('Times','',11);
			$products_commands=$this->_commandDAO->getAllProductsCommandsByCommandId($command->getId());
			foreach($products_commands as $pc){
				$product=$this->_productDAO->getProductById($pc->getProduct_id());
				if($product!=null && $product->getType()=='E'){
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Produit: '.$product->getDesignation()),0,1);
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Quantité: '.$pc->getQuantity()),0,1);
				}
			}
			$this->_pdf->Ln();
			
			$this->_pdf->SetFont('Arial','B',11);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Pack 2: les plats'),0,1);
			$this->_pdf->Ln();
			$this->_pdf->SetFont('Times','',11);
			foreach($products_commands as $pc){
				$product=$this->_productDAO->getProductById($pc->getProduct_id());
				if($product!=null && $product->getType()=='P'){
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Produit: '.$product->getDesignation()),0,1);
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Quantité: '.$pc->getQuantity()),0,1);
				}
			}$this->_pdf->Ln();
			
			$this->_pdf->SetFont('Arial','B',11);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Pack 3: le pain et viennoiserie'),0,1);
			$this->_pdf->Ln();
			$this->_pdf->SetFont('Times','',11);
			foreach($products_commands as $pc){
				$product=$this->_productDAO->getProductById($pc->getProduct_id());
				if($product!=null && $product->getType()=='PV'){
					$total+=300;
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Produit: '.$product->getDesignation()),0,1);
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Quantité: '.$pc->getQuantity()),0,1);
					$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', '+300 DH'),0,1);
				}
			}
			$this->_pdf->Ln();
			$this->_pdf->SetFont('Arial','B',11);
			$this->_pdf->Cell(0,5,iconv('UTF-8', 'windows-1252', 'Total: '.$total.' DH'),0,1);
			
			$filename="../commands_pdf/command_".$command->getId()."_".$customer->getLastname().".pdf";
			$this->_pdf->Output($filename,'F');
			$this->_pdf->Output();

			$mail = new PHPMailer(true);
			$mail->isSMTP();
			$mail->Host       = 'smtp.gmail.com';                
			$mail->SMTPAuth   = true;                                   
			$mail->Username   = 'commande@ktec.ma';                    
			$mail->Password   = 'lz=(oj%]1+z';         
			$mail->Port       = 465;
			
			$mail->setFrom('commande@ktec.ma', 'Ktec');     // Add a recipient
			$mail->addAddress('commandes@ktec.ma');               // Name is optional
			$mail->addReplyTo('commande@ktec.ma', 'Information');	
			$mail->addAttachment($filename);
			$mail->Subject = 'Commande n°'.$command->getId();
			$mail->Body    = 'Commande n°'.$command->getId();
			$mail->send();
		}
	}