<?php 
    session_start();
    date_default_timezone_set("Asia/Rangoon");
    require_once "./db_connect.php";

        if(isset($_POST["itemsave"])){
        $staffname= $_POST["staffName"];
        $phone= $_POST["phoneNo"];
      
         $statement = $connection->prepare("INSERT INTO staff(staffName,phoneNo) VALUES(?,?)");
        $statement->bind_param("si", $staffname, $phone);
        if($statement->execute()) {
           // echo "<script>alert('Success Save.');location.assign('item_type.php');</script>";
        }
        else {
            $err = htmlspecialchars($statement->error);
            echo "<script>alert('$err');</script>";
        }
        $statement->close();
    }
    
        ?>
    


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
#selected5{
  color: red;
}

</style>
    <body>
        <div class="main">
        <div>
            <?php include("design_header.php");?>
            </div>
            
            <div class="body">
                <div class="bodydata">
                    <div class="body_heading">  Add Staff</div>
                    <div class="data_body">
                        <form method="POST" enctype="multipart/form-data">
                            <table>
                                <tr>
                                    <td>
                                    အမည်
                                    </td>
                            <td>
                            <input type="text" name="staffName" value="" maxlength="300"
                            </td>
                            </tr>
                            <td>
                            ဖုန်းနံပါတ် 
                                    </td>
                            <td>
                            <input type="number" name="phoneNo" value="phoneN0" maxlength="50"
                            </td>
                            </tr>
                            </table>
                     
                             
                       <br>
                        
                       <input type="submit" value="Cancel" name="cancel" formnovalidate class="submit_button" style="left: 500px;" />
                       <input type="submit" value="Save" name="itemsave" class="submit_button" style="right: 100px;" />     
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
