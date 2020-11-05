<?php
include("fpdf182/fpdf.php");
include("../includes/config.php");	

if(isset($_POST['submit'])){
	$sql = "SELECT MAX(orderId) AS lastId FROM orders";
	$query = $dbh -> prepare($sql);
	$query -> execute() or die();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount() > 0){
		foreach($results as $result){
			$orderId = htmlentities($result->lastId);
		}
	}

	$pdf = new FPDF('p', 'mm', 'a4');
	$pdf->AddPage();

	//set font to arial, bold, 14pt
	$pdf->SetFont('arial', 'b', '14');

	//cell(width, height, text, border, end line, align)
	$pdf->Cell(120, 5, 'Smart Phone Company', 0, 0);
	$pdf->Cell(69, 5, 'INOICE', 0, 1);

	$pdf->SetFont('arial', '', '12');
	$pdf->Cell(120, 5, '[Street Address]', 0, 0);
	$pdf->Cell(69, 5, '', 0, 1);


$sql3 = "SELECT * FROM orders WHERE orderId=:orderId";
$query = $dbh -> prepare($sql3);
$query -> bindParam(":orderId", $orderId, PDO::PARAM_INT);
$query -> execute() or die;
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
	foreach($results as $result){
		$pdf->Cell(120, 5, '[City, Coutry, Zip]', 0, 0);
		$pdf->Cell(25, 5, 'Date', 0, 0);
		$pdf->Cell(44, 5, htmlentities($result->date), 0, 1);

		$pdf->Cell(120, 5, 'Phone[016-7708248]', 0, 0);
		$pdf->Cell(25, 5, 'Invoice #', 0, 0);
		$pdf->Cell(44, 5, htmlentities($result->orderId), 0, 1, 'C');

		$pdf->Cell(120, 5, 'Fax[07-1234567]', 0, 0);
		$pdf->Cell(25, 5, 'Customer ID', 0, 0);
		$pdf->Cell(44, 5, htmlentities($result->customerId), 0, 1, 'C');
	}
}

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189, 10, '', 0, 1);

	//billing address
	$pdf->Cell(100, 5, 'Bill to', 0, 1);

	//add dummy cell at beginning of each line for indentation
	$pdf->Cell(10, 5, '', 0, 0);
	$pdf->Cell(90, 5, '[Name]', 0, 1);

	$pdf->Cell(10, 5, '', 0, 0);
	$pdf->Cell(90, 5, '[Company Name]', 0, 1);

	$pdf->Cell(10, 5, '', 0, 0);
	$pdf->Cell(90, 5, '[Address]', 0, 1);

	$pdf->Cell(10, 5, '', 0, 0);
	$pdf->Cell(90, 5, '[Phone]', 0, 1);

	//make a dummy empty cell as a vertical spacer
	$pdf->Cell(189, 10, '', 0, 1);

	//invoice contents
	$pdf->SetFont('Arial', 'B', 12);

	$pdf->Cell(110, 5, 'Description', 1, 0);
	$pdf->Cell(20, 5, 'Quantity', 1, 0);
	$pdf->Cell(25, 5, 'Taxable', 1, 0);
	$pdf->Cell(34, 5, 'Amount', 1, 1);

	$pdf->SetFont('Arial', '', 12);


//Numbers are right-aligned so we give 'R' after new line parameter
$sql2 = "SELECT order_details.productId, order_details.quantity, product.productName, product.unitPrice FROM order_details LEFT JOIN product ON order_details.productId = product.productId WHERE order_details.orderId=:orderId";
	$query = $dbh -> prepare($sql2);
	$query->bindParam('orderId',$orderId,PDO::PARAM_STR);
	$query -> execute() or die();
	$results=$query->fetchAll(PDO::FETCH_OBJ);
	if($query->rowCount()>0){
		$totalAmount = 0;
		foreach($results as $result){
			$totalAmount += (htmlentities($result->unitPrice) * htmlentities($result->quantity));

			$pdf->Cell(110, 5, htmlentities($result->productName), 1, 0,);
			$pdf->Cell(20, 5, htmlentities($result->quantity), 1, 0, 'C');
			$pdf->Cell(25, 5, '-', 1, 0, 'C');
			$pdf->Cell(34, 5, htmlentities($result->unitPrice), 1, 1, 'R');	
		}
	}

	//summary
	$pdf->Cell(110, 5, '', 1, 0);
	$pdf->Cell(45, 5, 'Subtotal', 1, 0);
	$pdf->Cell(4, 5, '$', 1, 0);
	$pdf->Cell(30, 5, $totalAmount, 1, 1, 'R');

	$pdf->Cell(110, 5, '', 1, 0);
	$pdf->Cell(45, 5, 'Taxable 0%', 1, 0);
	$pdf->Cell(4, 5, '$', 1, 0);
	$pdf->Cell(30, 5, '0', 1, 1, 'R');

	// $pdf->Cell(110, 5, '', 1, 0);
	// $pdf->Cell(45, 5, 'Tax Rate', 1, 0);
	// $pdf->Cell(4, 5, '$', 1, 0);
	// $pdf->Cell(30, 5, '0%', 1, 1, 'R');

	$pdf->Cell(110, 5, '', 1, 0);
	$pdf->Cell(45, 5, 'Total Due', 1, 0);
	$pdf->Cell(4, 5, '$', 1, 0);
	$pdf->Cell(30, 5, $totalAmount, 1, 1, 'R');


	$pdf->Output();


	

	
}
?>