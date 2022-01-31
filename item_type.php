<?php 
    session_start();
    date_default_timezone_set("Asia/Rangoon");
    require_once "./db_connect.php";

        if(isset($_POST["itemsave"])){
        $itname= $_POST["itemName"];
        $price= $_POST["price"];
      
         $statement = $connection->prepare("INSERT INTO item(itemName,price) VALUES(?,?)");
        $statement->bind_param("si", $itname, $price);
        if($statement->execute()) {
          //  echo "<script>alert('Success Save.');location.assign('item_type.php');</script>";
        }
        else {
            $err = htmlspecialchars($statement->error);
            echo "<script>alert('$err');</script>";
        }
        $statement->close();
    }
    
        ?>
    
h

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CASH MEMO</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
        <link href="js/Datepicker/themes/ui-lightness/jquery.ui.all.css" rel="stylesheet" />
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/Datepicker/ui/minified/jquery.ui.core.min.js"></script>
        <script src="js/Datepicker/ui/minified/jquery.ui.datepicker.min.js"></script>
       
    </head>
    <style> 
#selected3{
  color: red;
}

</style>
    <body>
        <div class="main">
        
      <?php include("design_header.php"); ?>
    
            
            <div class="body">
                <div class="bodydata">
                    <div class="body_heading">ဝယ်ယူသည့်ပစ္စည်းများနှင့်တန်ဖိုးများ</div>
                    <div class="data_body">
                        <form method="POST" enctype="multipart/form-data">

                        <table>
                                <tr>
                                    <td>
                                    ပစ္စည်းအမျိုးအမည်
                                    </td>
                            <td>
                            <input type="text" name="itemName" value="" maxlength="300"
                                    required placeholder="ပစ္စည်းအမျိုးအမည်" title="ပစ္စည်းအမျိုးအမည်ရိုက်ထည့်ပါ" />
                            </td>
                            </tr>
                            <td>
                            ဈေးနှုန်း
                                    </td>
                            <td>
                            <input type="number" name="price" value="Price" maxlength="50"
                                    required placeholder="ဈေးနှုန်း" title="ဈေးနှုန်းရိုက်ထည့်ပါ" />
                            </td>
                            </tr>
                            </table>
                     



                   
                       <br>
                       <div style="text-align: center;">  
                       <input type="submit" value="Cancel" name="cancel" formnovalidate class="submit_button" style="left: 500px;" />
                       <input type="submit" value="Save" name="itemsave" class="submit_button" style="right: 100px;" />   
</div>  
                      </form>   
                   </div>
                </div>
            </div>
            
            <div class="footer">
            <?php include("design_footer.php");?>
            </div>
        </div>
    </body>
</html>
