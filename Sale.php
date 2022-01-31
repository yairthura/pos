<?php
    session_start();
    date_default_timezone_set("Asia/Rangoon");
    require_once "./db_connect.php";
    if(isset($_POST["save"])) {

       // $clientID=$_POST["clientID"];
        $name=$_POST["name"];
        $email=$_POST["email"];
        $company=$_POST["company"];
        $address= $_POST["address"];
        $phone=$_POST["phone"];
         $statement = $connection->prepare("INSERT INTO clients(clientID,name,email,company,address,phone) VALUES(?,?,?,?,?,?)");
        $statement->bind_param("isssss",$clientID ,$name,$email, $company,$address,$phone );
        if($statement->execute()) {
          echo "<script>location.assign('invoice.php?clientName=$name');</script>";
        }
        else {
            $err = htmlspecialchars($statement->error);
            echo "<script>alert('$err');</script>";
        }
        $statement->close();
    }
   // $name = ""; $foundeddate = date('Y-m-d'); $age = ""; $description = ""; $image = "";
    
    $clientID="";$name=""; $email=""; $company=""; $address=""; $phone="";
        if(isset($_SESSION["sid"])) {
        $statement = $connection->prepare("SELECT * FROM clients WHERE clientID = ?");
        $statement->bind_param("i", $_SESSION["sid"]);
        $statement->execute();
        $statement->bind_result($id,$name, $email, $company, $address, $phone);
        $statement->fetch();
        $statement->close();
    }
//     if(isset($_POST["update"])) {
        
// //        $q= $_POST["quantity"];
// //        $up= $_POST["unitprice"];
// //        $amount= $q*$up;
// //        $totalamount= $amount;
//             $statement = $connection->prepare("UPDATE client SET name = ?, email = ?, company = ?, address = ?, phone = ? WHERE clientid = ?");
//             $statement->bind_param("ssssssi", $_POST["name"], $_POST["email"], $_POST["company"], $_POST["address"],$_POST["phone"],$_SESSION["sid"]);
//             if($statement->execute()) {
//                 unset($_SESSION["sid"]);
//                // echo "<script>alert('Success update.');location.assign('Sale_List.php');</script>";
//             }
//             else {
//                 $err = htmlspecialchars($statement->error);
//                 echo "<script>alert('$err');</script>";
//             }
        
         
//         $statement->close();
//     }
//    if(isset($_POST["updatecancel"])) {
//         unset($_SESSION["sid"]);
//         header("Location: Sale_List.php");
//     }
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
#selected1{
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
                    <div class="body_heading">အချက်အလက်များဖြည့်သွင်းခြင်း</div>
                    <div class="data_body">
                        <form method="POST" enctype="multipart/form-data">
                           <?php if(!isset($_SESSION["adminid"])) { ?>
                            <div class="login">You are not log in. Please log in to gain access on ADMIN site.</div>
                            <?php } else { ?>   
                         
                            <table>

                            <tr>
                                <td>
                                ဝယ်ယူသူကိုယ်ပိုင်အမည်<span style="color:red">*</span>
                            </td>
                            <td>
                            <input type="text" name="name" value="<?php echo $name; ?>" maxlength="50" 
                                             required placeholder="ဝယ်ယူသူကိုယ်ပိုင်အမည်" title="ဝယ်ယူသူကိုယ်ပိုင်အမည်ရိုက်ထည့်ပါ" />
                            </td>
                            </tr>

                            <tr>
                                <td>
                                ဝယ်ယူသူ Email လိပ်စာ
                            </td>
                            <td>
                            <input type="text" name="email"  maxlength="50"
                                    placeholder="ဝယ်ယူသူ Email လိပ်စာ" title="ဝယ်ယူသူ Email လိပ်စာရိုက်ထည့်ပါ" />
                            </td>
                            </tr>
                            <tr>
                                <td> ဝယ်ယူသူအမည် (Company Name) </td>
                                <td>
                                <input type="text" name="company"  maxlength="50"  placeholder="Company Name"
                                    title="ဝယ်ယူသူအမည် (Company Name)ရိုက်ထည့်ပါ" />
                                </td>
                            </tr>

                            <tr>
                                <td>
                                ဝယ်ယူသူလိပ်စာ<span style="color:red">*</span>
                            </td>
                            <td>
                            <input type="text" name="address"  maxlength="20" 
                                    required placeholder="ဝယ်ယူသူလိပ်စာ" title="ဝယ်ယူသူလိပ်စာရိုက်ထည့်ပါ" />
                            </td>
                            </tr>
                            <tr>
                                <td> ဝယ်ယူသူဖုန်းနံပါတ်<span style="color:red">*</span></td>
                                <td><input type="text" name="phone" maxlength="300"
                                    required placeholder="ဝယ်ယူသူဖုန်းနံပါတ်" title="ဝယ်ယူသူဖုန်းနံပါတ်ရိုက်ထည့်ပါ" /></td>
                            </tr>
                           
                            </table>    
                     
                    
                                   <br>
                               <div style="text-align: center;">    
                            <input type="submit" value="<?php echo (isset($_SESSION["sid"]))? "Update": "Save"; ?>" name="<?php echo (isset($_SESSION["sid"]))? "update": "save"; ?>" class="submit_button" id="submit" style="left: 400px;" />
                            <input type="submit" value="Cancel" name="<?php echo (isset($_SESSION["sid"]))? "updatecancel": "savecancel"; ?>" class="submit_button" formnovalidate id="submit" style="right: 200px;" /> 
                            </div> <?php } ?> 
                                                    
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
