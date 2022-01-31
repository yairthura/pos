<?php
require_once "./db_connect.php";
require_once 'FPDF/fpdf.php';
$clientID = $_GET['clientID'];


$sql = "SELECT * FROM invoice where clientID = $clientID";
$q = $connection->query($sql);
$s = $connection->query($sql);



$staff = mysqli_fetch_assoc($s);

//
$sum = "SELECT SUM(amount)
FROM invoice where clientID = $clientID";
$data = $connection->query($sum);

$finaldata = mysqli_fetch_array($data);

//



?>
<?php



class PDF extends FPDF
{
  // Page header
  function Header()
  {
    // Logo
    $this->Image('image/TC.jpg', 12, 3, 25, 25);


    // Arial bold 15
    $this->SetFont('Arial', 'B', 17);

    // Move to the right
    $this->Cell(90);

    // Title
    
    $this->Cell(20, 10, 'Computer Training,Sale,Service & Mobile Mart', 0, 1, 'C');

    $this->SetFont('Arial', 'B', 10);

    $this->Cell(50);
    $this->Cell(20, 10, 'Head Office', 0, 0);
    $this->Cell(5, 10, ':', 0, 0);
    $this->Cell(15, 10, 'Yangon;', 0, 0);
    
    
    $this->Cell(18, 10, 'Center(1)', 0, 0);
    $this->Cell(5, 10, ':', 0, 0);
    $this->Cell(15, 10, 'Yangon', 0, 1);
    

    // Line break
    $this->Ln(1);
  }

  // Page footer
  function Footer()
  {
    // Position at 1.5 cm from bottom
    $this->SetY(-70);

    // Arial italic 8
    $this->SetFont('Arial', 'b', 12);

    // Page number
    //$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    $this->Cell(100, 10, "--------------------------------------------", 0, 0);
    $this->Cell(80, 10, "--------------------------------------------", 0, 1, 'R');
    $this->Cell(100, 0, "Customer's Signature", 0, 0);
    $this->Cell(80, 0, " Authorized's's Signature", 0, 0, 'R');

    $this->Ln(9);
    $this->Cell(40);
    $this->Cell(100,10,"cgchhhhhhhhhhjhjhglghjhhkjhkj",0,1,'C');
    $this->Cell(40);
    $this->Cell(80,0," chhjhbjvhghjghjghjghjghjghjg",0,0,'C');
  }
}

$pdf = new PDF('P', 'mm', 'A4');
$pdf->SetFont('arial', 'b', '14');
$pdf->AddPage();

$pdf->Ln(7);
$pdf->Cell(30, 10, 'Head Office', 0, 0, 'L');
$pdf->Cell(5, 10, ':', 0, 0);
$pdf->Cell(30, 10, 'Yangon', 0, 1);



$pdf->Cell(30, 10, 'Center(1)', 0, 0, 'L');
$pdf->Cell(5, 10, ':', 0, 0);
$pdf->Cell(30, 10, 'Yangon', 0, 1);




$pdf->cell('30', '10', 'Staff_Name', '0');
$pdf->Cell(5, 10, ':', 0, 0);
$pdf->cell('80', '10', $staff['staffName'], '0', '0');

$pdf->cell('30', '10', 'Staff_Name', '0');
$pdf->Cell(5, 10, ':', 0, 0);
$pdf->cell('30', '10', $staff['staffName'], '0', '1');

$pdf->cell('30', '10', 'Date', '0');
$pdf->Cell(5, 10, ':', 0, 0);
$pdf->cell('80', '10', $staff['date'], '0', '0');

$pdf->cell('30', '10', 'InvoiceID', '0');
$pdf->Cell(5, 10, ':', 0, 0);
$pdf->cell('30', '10', $staff['invoiceID'], '0', '3');

$pdf->Ln(8);

if (isset($_POST['btn_pdf'])) {

  $pdf->cell('10', '10', 'No', '1', '0', 'C');
  $pdf->cell('50', '10', 'Particulat', '1', '0', 'C');

  $pdf->cell('20', '10', 'Qty', '1', '0', 'C');
  $pdf->cell('50', '10', 'Price', '1', '0', 'C');
  $pdf->cell('50', '10', 'Amount', '1', '1', 'C');

  $pdf->SetFont('arial', 'b', '14');
  if($q -> num_rows > 0){
    $i=0;
  
  while ($rw = mysqli_fetch_assoc($q)) {
    $i++;

    $pdf->cell('10', '10',  $i, '1', '0', 'C');
    $pdf->cell('50', '10',  $rw['itemName'], '1', '0', 'C');

    $pdf->cell('20', '10',  $rw['quantity'], '1', '0', 'C');
    $pdf->cell('50', '10',  $rw['price'], '1', '0', 'C');

    $pdf->cell('50', '10',  $rw['amount'], '1', '1', 'C');



    //   $pdf->cell('20','10',  $rw['clientID'], '1','0','C');
    //   $pdf->cell('20','10',  $rw['itemID'], '1','1','C');
  }
}
  $pdf->cell('90', '10',  '', '0', '0', 'C');
  $pdf->cell('40', '10',  'Total Amount', '0', '0', 'C');
  $pdf->cell('50', '10',  $finaldata[0], '1', '1', 'C');

  $pdf->cell('90', '10',  '', '0', '0', 'C');
  $pdf->cell('40', '10',  'Paid Amount', '0', '0', 'C');
  $pdf->cell('50', '10',  $finaldata[0], '1', '1', 'C');

  $pdf->cell('90', '10',  '', '0', '0', 'C');
  $pdf->cell('40', '10',  'Balance', '0', '0', 'C');
  $pdf->cell('50', '10',  '0.00', '1', '0', 'C');

  //$pdf->AliasNbPages();

  $pdf->Output();
  //  $pdf->Output();
}



?>



<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="CSS /bootstrap.css">
  <title>Document</title>
</head>

<body style="background: #CCCCCC">
  <div class="row">
    <div class="col">
      <div>
        <div class="card mt-5">
          <div class="card-header">
            <form action="" method="POST">
              <button name="btn_pdf" type="submit" class="btn-success" style="width:40px;height:40px;"> </button>

          </div>
          <!-- <?php include("header.php"); ?> -->
          <div>

            <table class="table ">
              <tr>
                <th>
                  Invoice ID
                </th>
                <th>
                  Date
                </th>
                <th>
                  Quantity
                </th>
                <th>
                  Amount
                </th>
                <!-- <th>
                                 ClientID
                            </th>
                            <th>
                                 ItemID
                            </th> -->
              </tr>
              <?php


              while ($rw = mysqli_fetch_array($q)) {

              ?>

                <tr>
                  <td><?php echo  $rw['invoiceID'] ?></td>
                  <td><?php echo  $rw['date'] ?></td>
                  <td><?php echo  $rw['quantity'] ?></td>
                  <td><?php echo  $rw['amount'] ?></td>

                </tr>

              <?php } ?>
              <tr>
                <td colspan="2"></td>
                <td> Total Amount </td>
                <td> <?php echo $finaldata[0] ?> </td>
              </tr>
            </table>
            </form>
          </div>
          <!-- <?php include("footer.php"); ?> -->
        </div>
      </div>

    </div>

  </div>




</body>

</html>