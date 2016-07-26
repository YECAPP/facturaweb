<?php 
	require_once('tcpdf/tcpdf_include.php');
	require_once('tcpdf/tcpdf.php');
	//require('mypdf.php');

	$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// ---------------------------------------------------------
	// set document information
	$pdf->SetCreator(PDF_CREATOR);
	$pdf->SetAuthor('Nicola Asuni');
	$pdf->SetTitle('TCPDF Example 001');
	$pdf->SetSubject('TCPDF Tutorial');
	$pdf->SetKeywords('TCPDF, PDF, example, test, guide');


// set default header data
	$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.' 001', PDF_HEADER_STRING, array(0,64,255), array(0,64,128));
	$pdf->setFooterData(array(0,64,0), array(0,64,128));

// set header and footer fonts
	$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
	$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

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
	$pdf->SetFont('times', '', 12, '', true);

	// Add a page
	// This method has several options, check the source code documentation for more information.
	$pdf->AddPage();

// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

// Set some content to print
/*$html = <<<EOD
<h1>Welcome to 
<a href="http://www.tcpdf.org" style="text-decoration:none;background-color:#CC0000;color:black;">&nbsp;<span style="color:black;">TC</span><span style="color:white;">PDF</span>&nbsp;</a>!</h1>
<i>This is the first example of TCPDF library.</i>
<p>This text is printed using the <i>writeHTMLCell()</i> method but you can also use: <i>Multicell(), writeHTML(), Write(), Cell() and Text()</i>.</p>
<p>Please check the source code documentation and other examples for further information.</p>
<p style="color:#CC0000;">TO IMPROVE AND EXPAND TCPDF I NEED YOUR SUPPORT, PLEASE <a href="http://sourceforge.net/donate/index.php?group_id=128076">MAKE A DONATION!</a></p>
EOD;
*/

// Print text using writeHTMLCell()
//$pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);

// Close and output PDF document
// This method has several options, check the source code documentation for more information.

$txt = 'Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente: Cliente:';
$txt2 = 'YEc';
// print a block of text using Write()
//$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(0, $txt2, '', 0, 'L', true, 0, false, false, 0);
//$pdf->Write(0, $txt, '', 0, 'L', true, 0, false, false, 0);
// Multicell test
$txtCliente="Cliente numero Uno, Sa. de c.v. ";
$direccion="Direcion calle del bosque nnumero 54 barrio x ";
$cantidad=1;
$concepto="Venta de MErcaderia :";
$precio=100;
$iva=21;
$total=121;

$pdf->MultiCell(25, 5,"Cliente:", 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(0, 5,$txtCliente, 1, 'L', 1, 0, '', '', true);
$pdf->Ln(6);
$pdf->MultiCell(25, 5,"Direccion:", 0, 'L', 1, 0, '', '', true);
$pdf->MultiCell(0, 5,$direccion, 1, 'L', 1, 0, '', '', true);

$pdf->Ln(20);

$pdf->MultiCell(25, 5,"Cantidad:", 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(105, 5,"Concepto:", 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 5,"Precio:", 1, 'L', 1, 0, '', '', true);
$pdf->MultiCell(25, 5,"Iva:", 1, 'L', 1, 0, '', '', true);
$pdf->Ln(12);
$lnCount=0;
for($i=0; $i <100 ; $i++) { 
	
	$pdf->MultiCell(25, 5,$cantidad, 	0, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(105, 5,$concepto.$i,0, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(25, 5,$precio, 		0, 'L', 1, 0, '', '', true);
	$pdf->MultiCell(25, 5,$iva, 		0, 'L', 1, 0, '', '', true);

	
	if ($lnCount==25||$lnCount==50){
		$pdf->AddPage();
	}
 	else {
 		$pdf->Ln(8);	
 	}
 	$lnCount++;
}

// $pdf->MultiCell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);
// $pdf->Ln(6);
// $pdf->MultiCell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);
// $pdf->Ln(6);
// $pdf->MultiCell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);
// $pdf->Ln(6);
// $pdf->MultiCell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);
// $pdf->MultiCell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);
// $pdf->MultiCell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);
// $pdf->Ln(6);
// $pdf->Cell(55, 5,$txt2, 1, 'L', 1, 0, '', '', true);


$pdf->Output('example_001.pdf', 'I');


//============================================================+
// END OF FILE
//============================================================+


?>







