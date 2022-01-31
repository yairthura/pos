<?php
    session_start();
    date_default_timezone_set("Asia/Rangoon");
    require_once "./db_connect.php";
    if(isset($_POST["register"])) {
        $statement = $connection->prepare("INSERT INTO member(name,email,username,password,dateofbirth,address,postcode) VALUES(?,?,?,?,?,?,?)");
        $statement->bind_param("ssssssi", $_POST["name"], $_POST["email"], $_POST["username"], $_POST["password"], $_POST["birthdate"], $_POST["address"], $_POST["postcode"]);
        if($statement->execute()) {
            echo "<script>alert('Success register.');location.assign('login.php');</script>";
        }
        else {
            $err = htmlspecialchars($statement->error);
            echo "<script>alert('$err');</script>";
        }
        $statement->close();
    }
    
    $today = new DateTime("today");
    date_sub($today, date_interval_create_from_date_string("18 years"));
    $maxdate = date_format($today, "Y-m-d");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>PAPRD</title>
        <link href="sal_css.css" rel="stylesheet" type="text/css"/>
        <link href="js/Datepicker/themes/ui-lightness/jquery.ui.all.css" rel="stylesheet" />
        <script src="js/jquery-3.3.1.min.js"></script>
        <script src="js/Datepicker/ui/minified/jquery.ui.core.min.js"></script>
        <script src="js/Datepicker/ui/minified/jquery.ui.datepicker.min.js"></script>
        <script>
            $(function() {
                $("#birthdate").datepicker();
                $("#birthdate").datepicker("option", "dateFormat", " yy-mm-dd");
                $("#birthdate").datepicker("option", "changeMonth", true);
                $("#birthdate").datepicker("option", "changeYear", true);
                $("#birthdate").datepicker("option", "maxDate", "-18y");
		$("#birthdate").datepicker("option", "minDate", "-100y");
                $("#birthdate").datepicker("setDate", "<?php echo $maxdate ?>");
            });
        </script>
    </head>
    <body>
        <div class="main">
            <div class="banner">
                <div class="bannertext">စီမံကိန်းစိစစ်ရေးနှင့်တိုးတက်မှုအစီရင်ခံရေးဦးစီးဌာန</div>
                 <div class="menu">
                    <a href=""><div class="menuitem" >Home</div></a>
                    <?php if(isset($_SESSION["memberid"])) { ?>
                    <a href="profile.php"><div class="menuitem" >Profile</div></a>
                    <a href="Staff_Bio_List_member.php"><div class="menuitem">Bio List</div></a>
                    <a href="Training_List_member.php"><div class="menuitem">Training List</div></a>
                    <a href="logout.php"><div class="menuitem">Log Out</div></a>
                    <?php } else { ?>
                     <a href="register.php"><div class="menuitem" id="selectedmenuitem">Register</div></a>
                    <a href="login.php"><div class="menuitem">Log In</div></a>
                    <a href="Staff_Bio.php"><div class="menuitem">Staff Bio</div></a>
                    <a href="Training.php"><div class="menuitem">Training</div></a>
                    <a href="aboutus.php"><div class="menuitem">About Us</div></a>
                    <a href="logout.php"><div class="menuitem">Log Out</div></a>
                    <?php } ?>
                </div>
            </div>
            
            <div class="body">
                <div class="bodydata">
                    <div class="body_heading">Register</div>
                    <form method="POST">
                        <input type="text" name="name" value="" maxlength="50" required placeholder="Enter Name" title="Customer Name" /><br>
                        <input type="email" name="email" value="" maxlength="50" required placeholder="Enter Email" title="Customer Email" /><br>
                        <textarea name="address" maxlength="100" required placeholder="Enter Address" title="Customer Address" ></textarea><br>
                        <input type="text" name="postcode" value="" pattern="[0-9]{5}" required placeholder="Enter Post Code" title="Customer Post Code" /><br>
                        <input type="text" name="birthdate" id="birthdate" value="" required title="Customer Date of Birth" /><br>
                        <input type="text" name="username" value="" maxlength="20" required placeholder="Enter User Name" title="Customer User Name" /><br>
                        <input type="password" name="password" value="" maxlength="20" required onchange="document.getElementById('cp').pattern=this.value;" placeholder="Enter Password" title="Customer Password" /><br>
                        <input type="password" name="confirmpassword" id="cp" value="" required placeholder="Retype Password" title="Re-enter Password" /><br>
                        <input type="submit" value="Register" name="register" class="submit_button" />
                    </form>
                </div>
            </div>
            
            <div class="footer">
            <?php include("design_footer.php");?>
            </div>
        </div>
    </body>
</html>
