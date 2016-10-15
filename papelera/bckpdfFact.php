<?php 
if (isset($_GET['idfact'])){

	require_once('tcpdf/tcpdf_include.php');
	require_once('tcpdf/tcpdf.php');


//CONSULTANDO LOS DATOS DE LA FACTURA ****************************************************************************************
	require_once 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 

	$idfactura=$_GET['idfact'];

	//Definiendo la variable sql 
    $sql="SELECT ";
    $sql.="f.IDFACTURA, ";
    $sql.="f.IDCLIENTE, ";
    $sql.="f.NUMERO, ";
    $sql.="f.DESCRIP, ";
    $sql.="c.NOMBRE, ";
    $sql.="c.DIRECC, ";
    $sql.="f.FECHA ";
    $sql.="FROM y_factura as f inner join y_client as c on f.IDCLIENTE=c.IDCLIENTE ";
    $sql.="WHERE IDFACTURA=:idfactura";
    
    $stmt = $pdo->prepare($sql);
	$rows=$stmt->execute(array(':idfactura'=>$idfactura));
	//echo $sql;
	if( $rows > 0 ){
		while($row=$stmt->fetch()){
			
			$idfactura=$row["IDFACTURA"];
			$numero=$row["NUMERO"];
			$idcliente=$row["IDCLIENTE"];
			$descrip=$row["DESCRIP"];
			$direccion=$row["DIRECC"];
			$nombre=$row["NOMBRE"];
			$fecha=$row["FECHA"];
			$iva=21;
			$total=100;

		}
	}else{
		
	}
// ---------------------------------------------------------

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'Logo.jpg';
        $this->Image($image_file, 20, 0, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$this->SetFont('helvetica', '', 40);
		$this->MultiCell(90, 10,"", 0, 'L', 0, 0, '', '', true);
		$this->MultiCell(90, 40,"Factura", 0, 'L', 0, 0, '', '', true);
		
		$this->SetFont('helvetica', '', 10);
		$this->Ln(15);
		$this->MultiCell(90, 10,"", 0, 'L', 0, 0, '', '', true);
		$this->MultiCell(90, 10,"Fecha:", 0, 'L', 0, 0, '', '', true);
		$this->Ln(4);
		$this->MultiCell(90, 10,"", 0, 'L', 0, 0, '', '', true);
		$this->MultiCell(90, 10,"No de Factura:", 0, 'L', 0, 0, '', '', true);
		
		$this->Ln(4);
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(90, 10,"Profeshop Books & Gifts SL", 0, 'L', 0, 0, '', '', true);

		$this->MultiCell(90, 10,"Direccion cliente", 0, 'L', 0, 0, '', '', true);
		$this->Ln(4);

        // Set font
        $this->SetFont('helvetica', '', 10);
        // Title
        //$this->Cell(0, 10, 'c/ Grumete, 12', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->MultiCell(90, 10,"c/ Grumete, 12", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(90, 10,"Direccion cliente2", 0, 'L', 0, 0, '', '', true);	
        $this->Ln(4);
        //$this->Cell(0, 10, '28260 Galapagar', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->MultiCell(90, 10,"28260 Galapagar", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(90, 10,"Direccion cliente3", 0, 'L', 0, 0, '', '', true);	
        $this->Ln(4);
        //$this->Cell(0, 10, 'Madrid', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->MultiCell(90, 10,"Madrid", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(90, 10,"Direccion cliente4", 0, 'L', 0, 0, '', '', true);
		$this->Ln(4);
        //$this->Cell(0, 10, 'cif: B-87559258', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->MultiCell(90, 10,"cif: B-87559258", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(90, 10,"Direccion cliente5", 0, 'L', 0, 0, '', '', true);
        $this->Ln(4);
		$this->MultiCell(90, 10,"Tf: 722.231.496", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(90, 10,"Direccion cliente6", 0, 'L', 0, 0, '', '', true);
        //$this->Cell(0, 10, 'Tf: 722.231.496', 0, false, 'L', 0, '', 0, false, 'M', 'M');

    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('');
	$pdf->SetTitle('Factura Web ');
	$pdf->SetSubject('www.tiservicios.net');
	$pdf->SetKeywords('Factura,Profeshop');


	// set default monospaced font
	$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

	// set margins
	$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
	$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
	$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

	// set auto page breaks
	$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

	// set image scale factor
	$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

	// set some language-dependent strings (optional)
	if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
		require_once(dirname(__FILE__).'/lang/eng.php');
		$pdf->setLanguageArray($l);
	}
	// set default font subsetting mode
	$pdf->setFontSubsetting(true);
	// Set font
	// dejavusans is a UTF-8 Unicode font, if you only need to
	// print standard ASCII chars, you can use core fonts like
	// helvetica or times to reduce file size.
	$pdf->SetFont('times', '', 10, '', true);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();

	// set text shadow effect
	$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///detalle de facturas 
	$sql="SELECT ";
    $sql.="f.IDFACTURA, ";
    $sql.="f.IDPRODUCTO, ";
    $sql.="f.CODIGO, ";
    $sql.="p.DESCRIP, ";
    $sql.="f.CANTIDAD, ";
    $sql.="f.PRECIO, ";
    $sql.="f.TAX ";
    $sql.="FROM y_facturaline as f inner join y_producto as p on f.IDPRODUCTO=p.IDPRODUCTO ";
    $sql.="WHERE f.IDFACTURA=:idfactura";
    
	$stmt = $pdo->prepare($sql);
	$rows=$stmt->execute(array(':idfactura'=>$idfactura));

	$pdf->MultiCell(25, 5,"Cantidad:", 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(80, 5,"Concepto:", 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(25, 5,"Precio:", 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(25, 5,"Iva:", 1, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(25, 5,"Total:", 1, 'L', 1, 0, '', '', true);
	$pdf->Ln(12);
	$lnCount=1;


	setlocale(LC_MONETARY, 'es_ES.UTF-8');

	if( $rows > 0 ){
		while($row=$stmt->fetch()){
			
			$idproductoLine=$row["IDPRODUCTO"];
			$codigoLine=$row["CODIGO"];
			$descripLine=$row["DESCRIP"]."(".$row["TAX"].")";
			$cantidadLine=$row["CANTIDAD"];
			$precioLine=money_format("%.2n", $row["PRECIO"] );
			
			//calculando el iva 
			if($row["TAX"]==0){
				$ivaLine=money_format("%.2n",0.00);
				$totalLine=money_format("%.2n",round($row["PRECIO"]*$row["CANTIDAD"],2));
			}else{
				$ivaLine=money_format("%.2n",round($row["PRECIO"]*$row["CANTIDAD"]*$row["TAX"]/100,2));
				$totalLine=money_format("%.2n",round($row["PRECIO"]*$row["CANTIDAD"]*(1+$row["TAX"]/100),2));
			}
			
			
			$pdf->MultiCell(25, 5,$cantidadLine, 	0, 'L', 1, 0, '', '', true);
			$pdf->MultiCell(80, 5,$descripLine,	0, 'L', 1, 0, '', '', true);
			$pdf->MultiCell(25, 5,$precioLine, 		0, 'L', 1, 0, '', '', true);
			$pdf->MultiCell(25, 5,$ivaLine, 		0, 'L', 1, 0, '', '', true);
			$pdf->MultiCell(25, 5,$totalLine, 		0, 'L', 1, 0, '', '', true);

			//$pdf->MultiCell(25, 5,$lnCount%25, 		0, 'L', 1, 0, '', '', true);
			
			if ($lnCount%25==0){
			 	$pdf->AddPage();
			 }
		 	else {
		  		$pdf->Ln(8);	
		  	}

		 	$lnCount++;

		}
	}else{
		
	}




//CONSULTANDO LOS DATOS DE LA FACTURA ****************************************************************************************

	$pdf->Output('example_001.pdf', 'I');

}
//============================================================+
// END OF FILE
//============================================================+

?>







