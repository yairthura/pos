<?php
session_start();
date_default_timezone_set("Asia/Rangoon");
require_once "./db_connect.php";


if(isset($_POST["itemUpdate"]))
{
 
    $itemName =$_POST["itemName"];
    $price =$_POST["price"];

    $statement = $connection->prepare(" UPDATE item SET price=? WHERE itemName = ?");

 

    $statement->bind_param("ss", $price,$itemName );
    if ($statement->execute()) {
      // echo "<script>alert('Success Save.');location.assign('pdf-sample.php?clientID=$client');</script>q";
    } else {
      $err = htmlspecialchars($statement->error);
      echo "<script>alert('$err');</script>";
    }
    $statement->close();


}




if(isset($_POST["cancel"])) {
    unset($_SESSION["sid"]);
    header("Location: Sale_List.php");
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

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript">

$(document).ready(function(){
$('#item').change(function(){
    $.get('getItemInfo.php',{item:$(this).val()},function(data){
    $('#price').val(data);
 });
});
});


// // $('#item').change(function(){
// //   var qty = $('#item').val();
// //   $("#totalprice").val(qty);
// //});
// </script>

</head>
<style>
    #selected2 {
        color: red;
    }
</style>

<body>
    <div class="main">

        <?php include("design_header.php"); ?>


        <div class="body">
            <div class="bodydata">
                <div class="body_heading">ပစ္စည်းတန်ဖိုးများပြောင်းလဲပြင်ဆင်ရန်</div>
                <div class="data_body">
                    <form method="POST" enctype="multipart/form-data">

                        <table>
                            <td>

                                Item Name
                            </td>
                            <td>
                                <select name="item" id="item">
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

                                    Price

                                </td>
                               
                                <td>
                                  <input type="text" name="price" id ="price">
                                </td>
                            </tr>

                        </table>




                        <br>
                        <div style="text-align: center;">
                            <input type="submit" value="Cancel" name="cancel" formnovalidate class="submit_button" style="left: 500px;" />
                            <input type="submit" value="Update" name="itemUpdate" class="submit_button" style="right: 100px;" />
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer">
            <?php include("design_footer.php"); ?>
        </div>
    </div>
</body>

</html>