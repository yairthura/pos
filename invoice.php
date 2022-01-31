<?php
session_start();
date_default_timezone_set("Asia/Rangoon");
require_once "./db_connect.php";
// session_start();
$sss = $_GET["clientName"];

$query = " Select * FROM clients WHERE name='$sss'  ORDER
    BY clientID DESC
 LIMIT 1
 ";

$q = $connection->query($query);
$rw = mysqli_fetch_array($q);
$client = $rw['clientID'];








if (isset($_POST["save"])) {

  $invoiceID = $_POST["invoiceID"];
  $item_Name = $_POST["itemName"];
  $staff_Name = $_POST["staffName"];
  $clientID = $client;
  $date = Date("Y-m-d");
  $quantity = $_POST["quantity"];



  $sql = " SELECT * FROM item WHERE itemName = '$item_Name' ";
  $q = $connection->query($sql);

  $rw = mysqli_fetch_array($q);

  $amount = $rw['price'] * $quantity;

  $itemID = $rw['itemID'];
  $price = $rw['price'];

  //  echo $staff_Name;

  $statement = $connection->prepare(" INSERT INTO invoice(invoiceID,date,quantity,price,amount,clientID,itemID,itemName,staffName) VALUES(?,?,?,?,?,?,?,?,?)");


  $statement->bind_param("sssssssss", $invoiceID, $date, $quantity, $price, $amount, $clientID, $itemID, $item_Name, $staff_Name);
  if ($statement->execute()) {
    // echo "<script>alert('Success Save.');location.assign('pdf-sample.php?clientID=$client');</script>q";
  } else {
    $err = htmlspecialchars($statement->error);
    echo "<script>alert('$err');</script>";
  }
  $statement->close();
}



if (isset($_POST["btn_pdf"])) {



  $location = "pdf-sample.php?clientID=" . $client;
  header("location:$location");
  exit();
}

    ?>





<!DOCTYPE html>
<html>

<head>
  <meta charset="UTF-8">
  <title>CASH MEMO</title>
  <link href="styles.css" rel="stylesheet" type="text/css" />
  <link href="js/Datepicker/themes/ui-lightness/jquery.ui.all.css" rel="stylesheet" />
  <script src="js/jquery-3.3.1.min.js"></script>
  <script src="js/Datepicker/ui/minified/jquery.ui.core.min.js"></script>
  <script src="js/Datepicker/ui/minified/jquery.ui.datepicker.min.js"></script>

</head>
<style> 
#selected1{
  color: red;
}

</style>
<body>
  <div class="main">
    <div>
      <?php include("design_header.php"); ?>
    </div>

    <div class="body">
      <div class="bodydata">
        <div class="body_heading">ဝယ်ယူသည့်ပစ္စည်းများနှင့်တန်ဖိုးများ</div>
        <div class="data_body">


          <form action="" method="POST" enctype="multipart/form-data" >


            <table>
              <tr>
                <td>
                  Invoice ID<span style="color:red">*</span>
                </td>
                <td>
                  <input type="number" id="invoice" name="invoiceID" value="Invoice ID ရိုက်ထည့်ပါ" maxlength="50" required placeholder="Invoice ID ရိုက်ထည့်ပါ" title="Invoice ID" />
                </td>
              </tr>

              <tr>
                <td>

                  ဝယ်ယူသည့်အရေအတွက်<span style="color:red">*</span>
                </td>
                <td>
                  <input type="number" id="qty" name="quantity" value="ဝယ်ယူသည့်အရေအတွက် ရိုက်ထည့်ပါ" maxlength="50" required placeholder="ဝယ်ယူသည့်အရေအတွက် ရိုက်ထည့်ပါ" title="ဝယ်ယူသည့်အရေအတွက်" />
                </td>
              </tr>

              <tr>
                <td>

                  Item Name<span style="color:red">*</span>
                </td>
                <td>
                  <select name="itemName" id="item">
                    <option value="">Choose Item name</option>


                    <?php
                    $sql = "select * from item";

                    $q = $connection->query($sql);

                    while ($rw = mysqli_fetch_array($q)) { ?>
                      <option value="<?php echo $rw['itemName']; ?>"><?php echo $rw['itemName']; ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>

              <tr>
                <td>

                  Staff<span style="color:red">*</span>

                </td>
                <td>
                  <select name="staffName">
                    <option value="">Choose Staff</option>

                    <?php
                    $sql = "select * from staff";

                    $q = $connection->query($sql);

                    while ($rw = mysqli_fetch_array($q)) { ?>
                      <option value="<?php echo $rw['staffName']; ?>"><?php echo $rw['staffName']; ?></option>
                    <?php } ?>
                  </select>
                </td>
              </tr>
            </table>
            <br>
<div style="text-align: center;">
            <input type="submit" value="Save" name="save" class="submit_button" style="right: 200px;"  onclick="myFunction()" />
            <input type="submit" value="DownLoad PDF" name="btn_pdf" formnovalidate class="submit_button" style="left: 800px;" />
                    </div>


          </form>
        </div>
        <script>
//            let input = document.querySelector("input");
//   input.addEventListener("submit", (event) => {
//     event.preventDefault();
//   })
// // function myFunction() {


// //   // document.getElementById("invoice").value= $_POST["invoiceID"];
// //    document.getElementById("item").value= "";

// // }

</script>
      </div>
    </div>



    <div class="footer">
      <?php include("design_footer.php"); ?>
    </div>
  </div>
</body>


</html>