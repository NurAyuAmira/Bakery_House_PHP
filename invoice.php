<?php
    include("dataconnection.php");
    session_start();

    $invoiceID = $_GET["Iid"];
    $invoiceResult = mysqli_query($connect,"select * from invoice where Invoice_ID = '$invoiceID'");
    $invoiceRow = mysqli_fetch_assoc($invoiceResult);
    $paymentID = $invoiceRow["Payment_ID"];
    $paymentResult = mysqli_query($connect,"select * from payment where Payment_ID = '$paymentID'");
    $paymentRow = mysqli_fetch_assoc($paymentResult);
    $orderID = $paymentRow["Order_ID"];
    $orderResult = mysqli_query($connect,"select * from orders where Order_ID = '$orderID'");
    $orderRow = mysqli_fetch_assoc($orderResult);
    $custID = $orderRow["Customer_ID"];
    $date = $invoiceRow["Invoice_Date"];

    if(!isset($_SESSION["CustID"])||$_SESSION["CustID"]!=$custID)
    {
        header("Location: trackorder.php");
    }

    require('fpdf184/fpdf.php');

    class PDF extends FPDF
    {
        // Page header
        function Header()
        {
            // Logo
            $this->Image('img/bakery.png',10,6,30);
            // Arial bold 15
            $this->SetFont('Arial','B',15);
            // Move to the right
            $this->Cell(30);
            // Title
            $this->Cell(30,20,'Bakery House',0,0,'L');
            $this->Cell(0,20,'Invoice',0,0,'R');
            // Line break
            $this->Ln(30);

        }

        function Footer()
        {
            // Position at 1.5 cm from bottom
            $this->SetY(-15);
            // Arial italic 8
            $this->SetFont('Arial','I',8);
            // Page number
            $this->Cell(0,10,'Bakery House Official.',0,0,'C');
        }
    

    }

    // Instanciation of inherited class
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetFont('Times','',12);
    
    $pdf->Cell(100,10,'Invoice ID : '.$invoiceID,0,0);
    $pdf->Cell(0,10,'Payment ID : '.$paymentID,0,1);
    $pdf->Cell(100,10,'Order ID : '.$orderID,0,0);
    $pdf->Cell(0,10,'Customer ID : '.$custID,0,1);
    $pdf->Cell(100,10,'Date : '.$date,0,1);
    

    $pdf->Ln(10);

    $pdf->setFillColor(255,238,89);
    $pdf->Cell(150,10,'Product Description','TL',0,'C',true,'');
    $pdf->Cell(0,10,'Price (RM)','TR',1,'C',true,'');

    $cartResult = mysqli_query($connect,"select * from cart where Order_ID = '$orderID'");

    while($row=mysqli_fetch_assoc($cartResult))
    {
        $prdID = $row["Product_ID"];
        $prdResult = mysqli_query($connect,"select * from product where Product_ID = '$prdID'");
        $prdRow = mysqli_fetch_assoc($prdResult);
        $prdName = $prdRow["Product_Name"];
        $prdReq = $row["Product_Requirement"];
        $prdPrice = $row["Total_Cost"];
        $prdReq = str_replace("<br>","\n",$prdReq);

        $pdf->setFillColor(255,249,234);
        $pdf->Cell(150,10,$prdName,'L',0,"L",true,'');
        $pdf->Cell(40,10,$prdPrice,'R',1,"C",true,'');
        $pdf->multiCell(0,10,$prdReq,'LR','L',true);
        $pdf->setFillColor(255,238,89);
        $pdf->Cell(0,10,'','1',1,"L",true,'');
        
 
    }

    $pdf->Ln(10);
    $total = $orderRow["Total_Amount"];
    $pdf->Cell(120,10,'',0,0,'',false,'');
    $pdf->Cell(30,10,'Total (RM)',1,0,'C',false,'');
    $pdf->Cell(40,10,$total,'1','1','C',false,'');

    
    $pdf->Output();



?>
