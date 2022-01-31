<?php
    session_start();
    date_default_timezone_set("Asia/Rangoon");
//    require_once "./db_connect.php";
    
       if(isset($_POST["sale"])) {


                echo "<script>alert('Welcome From Sale Page.');location.assign('Sale.php');</script>";
            }
            elseif(isset($_POST["repair"]))
            {
               
                echo "<script>alert('Welcome From Repair Page.');location.assign('Repair.php');</script>";
            }

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CASH MEMO</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="main">
        <div>
            <?php include("design_header.php");?>
            </div>
            
            <div class="body">
                <div class="bodydata">
                    <div class="body_heading">Please Choose Your Desire item.</div>

                    <form method="POST">
                         
                        <input type="submit" value="For Sale" name="sale" class="submit_button" style="top: 100px" />
                        <input type="submit" value="For Repair" name="repair" class="submit_button" style="top: 200px" />
                                
                    </form>

                </div>
            </div>
            
            <div class="footer">
            <?php include("design_footer.php");?>
            </div>
        </div>
    </body>
</html>
