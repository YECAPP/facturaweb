<?php 
if (isset($_GET['idfact'])){
require_once('tcpdf/tcpdf_include.php');
require_once('tcpdf/tcpdf.php');

$idfactura=$_GET['idfact'];
//CONSULTANDO LOS DATOS DE LA FACTURA ****************************************************************************************
require_once 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
//Definiendo la variable sql 
    
// ---------------------------------------------------------
require_once 'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 


// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {
    var $fact;
    var $email2Send;
    var $nombre2Send;
    //Page header
    public function Header() {
    
		include  'crud/dbconfig.php'; //se cambio 2 de julio por no funcionar con la clase 
		$idfactura=$this->fact;

		$sql="SELECT ";
	    $sql.="f.IDFACTURA, ";
	    $sql.="f.IDCLIENTE, ";
	    $sql.="c.CODIGO, ";
	    $sql.="f.NUMERO, ";
	    $sql.="f.DESCRIP, ";
	    $sql.="c.NOMBRE, ";
	    $sql.="c.DIRECC, ";
	    $sql.="c.TELEFONO, ";
	    $sql.="c.EMAIL, ";
	    $sql.="c.COD_POST, ";
	    $sql.="c.CDAD, ";
	    $sql.="c.ESTADO, ";
	    $sql.="c.CODTRIB, ";
	    $sql.="f.FECHA ";
	    $sql.="FROM y_factura as f inner join y_client as c on f.IDCLIENTE=c.IDCLIENTE ";
	    $sql.="WHERE IDFACTURA=:idfactura";
	    
	    $stmt = $pdo->prepare($sql);
		$rows=$stmt->execute(array(':idfactura'=>$idfactura));
		//echo $sql;

	
		if( $rows > 0 ){
			while($row=$stmt->fetch()){
				
				$pdfidfactura=$row["IDFACTURA"];
				$numero=$row["NUMERO"];
				$codigo=$row["CODIGO"];
				$idcliente=$row["IDCLIENTE"];
				$descrip=$row["DESCRIP"];
				$nombre=$row["NOMBRE"];
				$direccion=$row["DIRECC"];
				$telefono=$row["TELEFONO"];
				$email=$row["EMAIL"];
				$this->email2Send=$email;
				$this->nombre2Send=$nombre;
				$codpost=$row["COD_POST"];
				$cdad=$row["CDAD"];
				$estado=$row["ESTADO"];
				$codtrib=$row["CODTRIB"];
				$fecha=$row["FECHA"];
			}
		}else{
			
		}


	    // Logo
        $image_file = K_PATH_IMAGES.'Logo.jpg';
        $this->Image($image_file, 20, 0, 20, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);

		$this->SetFont('helvetica', '', 30);
		$this->MultiCell(60, 10,"", 0, 'L', 0, 0, '', '', true);
		$this->MultiCell(100, 10,"Factura No. ".$numero, 0, 'R', 0, 0, '', '', true);
		
		$this->SetFont('helvetica', '', 10);
		$this->Ln(15);
		$this->MultiCell(60, 10,"", 0, 'L', 0, 0, '', '', true);
		
		$this->SetFont('helvetica', 'B', 14);
		$this->MultiCell(120, 10,"Fecha: ".$fecha, 0, 'R', 0, 0, '', '', true);
		$this->Ln(4);
		
		$this->MultiCell(90, 10,"", 0, 'L', 0, 0, '', '', true);
		
		
		$this->Ln(4);
		$this->SetFont('helvetica', '', 10);
		$this->MultiCell(60, 10,"Profeshop Books & Gifts SL", 0, 'L', 0, 0, '', '', true);
		$this->MultiCell(120, 10,"".$nombre." Cod: ".$codigo, 0, 'R', 0, 0, '', '', true);
		
		$this->Ln(4);

        // Set font
        $this->SetFont('helvetica', '', 10);
        // Title
        //$this->Cell(0, 10, 'c/ Grumete, 12', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->MultiCell(60, 10,"c/ Grumete, 12", 0, 'L', 0, 0, '', '', true);	
        $this->MultiCell(120, 10,$direccion, 0, 'R', 0, 0, '', '', true);
        $this->Ln(4);
        //$this->Cell(0, 10, '28260 Galapagar', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->MultiCell(60, 10,"28260 Galapagar", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(120, 10,$cdad.", ".$estado, 0, 'R', 0, 0, '', '', true);	
        $this->Ln(4);
        //$this->Cell(0, 10, 'Madrid', 0, false, 'L', 0, '', 0, false, 'M', 'M');
		$this->MultiCell(60, 10,"Madrid", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(120, 10,$email, 0, 'R', 0, 0, '', '', true);
		$this->Ln(4);
        //$this->Cell(0, 10, 'cif: B-87559258', 0, false, 'L', 0, '', 0, false, 'M', 'M');
        $this->MultiCell(60, 10,"cif: B-87559258", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(120, 10,"cif:".$codtrib, 0, 'R', 0, 0, '', '', true);
        $this->Ln(4);
		$this->MultiCell(60, 10,"Tf: 722.231.496", 0, 'L', 0, 0, '', '', true);	
		$this->MultiCell(120, 10,"Tf:".$telefono, 0, 'R', 0, 0, '', '', true);	
		

		$style = array(	'width' => 0.1	, 
        				'cap' => 'butt', 
        				'join' => 'miter', 
        				'dash' => '0', 
        				'phase' => 10, 
        				'color' => array(43, 199, 10));



		$this->SetLineStyle($style);
		$this->Ln(5);
		$this->MultiCell(25, 5,"Codigo"		, 1, 'C', 0, 0, '', '', true);
		$this->MultiCell(70, 5,"Descripcion"	, 1, 'C', 0, 0, '', '', true);
		$this->MultiCell(20, 5,"Unidades"		, 1, 'C', 0, 0, '', '', true);
		$this->MultiCell(20, 5,"Precio Ud"		, 1, 'C', 0, 0, '', '', true);
		$this->MultiCell(20, 5,"Iva"			, 1, 'C', 0, 0, '', '', true);
		$this->MultiCell(25, 5,"Total"			, 1, 'C', 0, 0, '', '', true);

        //$this->Cell(0, 10, 'Tf: 722.231.496', 0, false, 'L', 0, '', 0, false, 'M', 'M');

    }

    public function writeTotalizar($subTotal,$Iva,$Total){
    	//totalizar el resultado de la facturas
    	//pintando la linea del subtotal 
        $this->SetTextColorArray(array(43,199,10));
		$this->SetFont('helvetica', '', 15);
		$this->MultiCell(120, 10,"Subtotal", 0, 'R', 0, 0, '', '', true);	
		$this->SetTextColorArray(array(0,0,0));
		$this->MultiCell(60, 10,money_format("%.2n",$subTotal), 1, 'C', 0, 0, '', '', true);	
		$this->Ln(12);
		//pintando la segunda linea del total 
		$this->SetFont('helvetica', 'B', 10);
		$this->MultiCell(60, 5,"Base Imponible:", 0, 'C', 0, 0, '', '', true);
		$this->MultiCell(60, 5,"Importe Iva:"	, 0, 'C', 0, 0, '', '', true);
		$this->MultiCell(60, 5,"Total Factura:"	, 0, 'C', 0, 0, '', '', true);
		//pintando los valores del total 
		$this->SetFont('helvetica', '', 15);
		$this->Ln(7);
		$this->MultiCell(60, 12,money_format("%.2n",$subTotal), 1, 'C', 0, 0, '', '', true);
		$this->MultiCell(60, 12,money_format("%.2n",$Iva)		, 1, 'C', 0, 0, '', '', true);
		$this->SetFont('helvetica', 'B', 20);
		$this->MultiCell(60, 12,money_format("%.2n",$Total)	, 1, 'C', 0, 0, '', '', true);
		//reseteando la fuente al original	
		$this->SetFont('helvetica', '', 10);
		//totalizar el resultado de la facturas
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
		$this->Cell(0, 10, 'Profeshop Books & Gifts SL, segura inscrita en el Registro Mercantil de Madrid ', 0, false, 'C', 0, '', 0, false, 'T', 'M');
		$this->ln(5);
		$this->Cell(0, 10, 'Tomo 34716 folio 1, hoja M-624403 Inscripción primera', 0, false, 'C', 0, '', 0, false, 'T', 'M');
        
        $this->Line(0,230, 210, 230);
        //$this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }
}

$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
	$pdf->fact=$idfactura;
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
	$email2Send=$pdf->email2Send;
	$nombre2Send=$pdf->nombre2Send;
// ---------------------------------------------------------
///////////////////////////////////////////////////////////////////////////////////////////////////////////
///detalle de facturas 
	$sql="SELECT ";
    $sql.="f.IDFACTURA, ";
    $sql.="f.IDPRODUCTO, ";
    $sql.="p.CODIGO, ";
    $sql.="p.DESCRIP, ";
    $sql.="f.CANTIDAD, ";
    $sql.="f.PRECIO, ";
    $sql.="f.TAX ";
    $sql.="FROM y_facturaline as f inner join y_producto as p on f.IDPRODUCTO=p.IDPRODUCTO ";
    $sql.="WHERE f.IDFACTURA=:idfactura";
    
	$stmt = $pdo->prepare($sql);
	$rows=$stmt->execute(array(':idfactura'=>$idfactura));
	$pdf->Ln(5);
	//variables de parametrizacion
	$lnCount=1; //conteo de lineas de la factura
	$lnPages=1; //conteo de paginas 
	$lnAltoLinea=5 ;//alto de la linea 
	$lnMargenEntreLines=5; //margen entrelineas de cada item
	$lnLinesxPag=350/($lnAltoLinea+$lnMargenEntreLines); //conteo de paginas 
	$lnLinesxPagAjuste=350%($lnAltoLinea+$lnMargenEntreLines); 
	$lnMargenSaltoPag=10; //margen entre totalizar y ultima linea 

	setlocale(LC_MONETARY, 'es_ES.UTF-8'); //establecer el formato a españa 
	//suma de totales 
	$Subtotal=0; 
	$IvaTotal=0;
	$Total=0;

	if( $rows > 0 ){
		while($row=$stmt->fetch()){
			//captura de los valores 
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
			//escribiendo la linea 
			$pdf->MultiCell(25, $lnAltoLinea,$codigoLine, 	0, 'L', 1, 0, '', '', true);
			$pdf->MultiCell(70, $lnAltoLinea,$descripLine,	0, 'L', 1, 0, '', '', true,0);
			$pdf->MultiCell(20, $lnAltoLinea,$cantidadLine,0, 'R', 1, 0, '', '', true);
			$pdf->MultiCell(20, $lnAltoLinea,$precioLine, 	0, 'R', 1, 0, '', '', true);
			$pdf->MultiCell(20, $lnAltoLinea,$ivaLine, 	0, 'R', 1, 0, '', '', true);
			$pdf->MultiCell(25, $lnAltoLinea,$totalLine, 	0, 'R', 1, 0, '', '', true);


			//Totalizando
			$Subtotal+=round($row["PRECIO"]*$row["CANTIDAD"],2);
			$IvaTotal+=round($row["PRECIO"]*$row["CANTIDAD"]*$row["TAX"]/100,2);
			$Total+=round($row["PRECIO"]*$row["CANTIDAD"]*(1+$row["TAX"]/100),2);

			//Salto de pagina 
			if ($lnCount%$lnLinesxPag==0){

				$lnPages++;
				$pdf->Ln($lnMargenSaltoPag)-$lnLinesxPagAjuste*$lnCount;	
				//totalizar el resultado de la facturas
				$pdf->writeTotalizar($Subtotal,$IvaTotal,$Total);

				//totalizar el resultado de la facturas

			 	$pdf->AddPage();
			 	$pdf->Ln($lnMargenEntreLines);	
			 }
		 	else {
		  		$pdf->Ln($lnMargenEntreLines);	
		  	}
		 	$lnCount++;
		}
		
		$pdf->Ln(($lnPages*$lnLinesxPag-$lnCount+1)*$lnMargenEntreLines+$lnMargenEntreLines
			-$lnLinesxPagAjuste*$lnCount
			);
		$pdf->writeTotalizar($Subtotal,$IvaTotal,$Total);

	}else{
		
	}


//CONSULTANDO LOS DATOS DE LA FACTURA **********************************************************************
	//$pdf->Output($_SERVER['DOCUMENT_ROOT'].'yErpsUBIR2/fact.pdf', 'F');
	$lcFilePdf="/factura".$idfactura.".pdf";
	$lcFilePdf2Send="factura".$idfactura.".pdf";
	$pdf->Output(__DIR__.$lcFilePdf, 'F');
 
	





date_default_timezone_set('Etc/UTC');

require 'PHPMailer/PHPMailerAutoload.php';

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.profeshop.es';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "ventas@profeshop.es";

//Password to use for SMTP authentication
$mail->Password = 'Vr+m77LJU0ceh283rSPCVl7pnYfawBVwxJ9dXOg9toA';

//Set who the message is to be sent from
$mail->setFrom('ventas@profeshop.es', 'Ventas Profeshop');

//Set an alternative reply-to address
$mail->addReplyTo('ventas@profeshop.es', 'Ventas Profeshop');

//Set who the message is to be sent to
$mail->addAddress($email2Send, $nombre2Send);

//Set the subject line
$mail->Subject = 'Envio de Factura';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
$mail->msgHTML(file_get_contents('PHPMailer/examples/contents.html'), dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'Estimado cliente, le estamos haciendo llegar su '.$lcFilePdf2Send;

//Attach an image file
$mail->addAttachment($lcFilePdf2Send);

//send the message, check for errors
if (!$mail->send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
} else {
     	echo $lcFilePdf2Send." correo <br>";
    	echo $email2Send." Enviado <br>";
}



}
//============================================================+
// END OF FILE
//============================================================+
?>







