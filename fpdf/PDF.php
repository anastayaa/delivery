<?php


	class PDF extends FPDF
	{
		private $_command_no;
		
		public function setCommand_no($command_no){
			$this->_command_no=$command_no;
		}
		
		// Page header
		function Header()
		{
			// Logo
			$this->Image('../public//logo.png',10,6,30);
			// Arial bold 15
			$this->SetFont('Arial','B',15);
			// Move to the right
			$this->Cell(80);
			// Title
			$this->Cell(60,10,iconv('UTF-8', 'windows-1252', 'Détails de la commande n° '.$this->_command_no),0,0,'C');
			// Line break
			$this->Ln(20);
			$this->Ln(20);
		}

		// Page footer
		function Footer()
		{
			$this->SetY(-20);
			$this->Image('../public/Bas_de_page.png', 5, null, 200, 20);
		}
	}
