<?php
    session_start();
    date_default_timezone_set("Asia/Rangoon");
    require_once "./db_connect.php";
    
    $loginlock = false;
    $remainminute = 5;
    
    $statement = $connection->prepare("SELECT * FROM login WHERE ipaddress = ?");
    $statement->bind_param("s", $_SERVER["REMOTE_ADDR"]);
    $statement->execute();
    $statement->bind_result($loginid, $ip, $count, $last);
    if($statement->fetch()) {
        $statement->close();
        
        $current = new DateTime("now");
        $lasttime = new DateTime($last);
        $diff = $current->diff($lasttime);
        $mins = round(((24 * $diff->d) * 60) + ($diff->h * 60) + $diff->i + ($diff->s / 60));
        if($mins > 5) {
            $statement = $connection->prepare("DELETE FROM login WHERE ipaddress = ?");
            $statement->bind_param("s", $_SERVER["REMOTE_ADDR"]);
            $statement->execute();
            $statement->close();
            $loginid = 0;
            $loginlock = false;
        }
        else {
            if($count == 3) {
                $remainminute = 5 - $mins;
                $loginlock = true;
            }
        }
    }
    else {
        $loginid = 0;
    }
    
    if(isset($_POST["login"])) {
//        $statement = $connection->prepare("SELECT memberid, name FROM member WHERE username = ? AND password = ?");
//        $statement->bind_param("ss", $_POST["username"], $_POST["password"]);
//        $statement->execute();
//        $statement->bind_result($mid, $name);
//        if($statement->fetch()) {
//            $statement->close();
//            $_SESSION["memberid"] = $mid;
//            $_SESSION["membername"] = $name;
//            
//            $statement = $connection->prepare("DELETE FROM login WHERE ipaddress = ?");
//            $statement->bind_param("s", $_SERVER["REMOTE_ADDR"]);
//            $statement->execute();
//            $statement->close();
//            
//            echo "<script>alert('Success login.');location.assign('index.php');</script>";
//        }
//        else {
//            $statement->close();
            $statement = $connection->prepare("SELECT adminid FROM admin WHERE username = ? AND password = ?");
            $statement->bind_param("ss", $_POST["username"], $_POST["password"]);
            $statement->execute();
            $statement->bind_result($adminid);
            if($statement->fetch()) {
                $statement->close();
                $_SESSION["adminid"] = $adminid;
                
                $statement = $connection->prepare("DELETE FROM login WHERE ipaddress = ?");
                $statement->bind_param("s", $_SERVER["REMOTE_ADDR"]);
                $statement->execute();
                $statement->close();

              echo "<script>location.assign('Sale.php');</script>";
            }
            else {
                $statement->close();
                if($loginid == 0) {
                    $statement = $connection->prepare("INSERT INTO login(ipaddress,attemptcount,lastlogin) VALUES(?,1,now())");
                    $statement->bind_param("s", $_SERVER["REMOTE_ADDR"]);
                    $statement->execute();
                    $statement->close();
                }
                else {
                    $statement = $connection->prepare("UPDATE login SET attemptcount = attemptcount + 1, lastlogin = now() WHERE loginid = ?");
                    $statement->bind_param("i", $loginid);
                    $statement->execute();
                    $statement->close();
                }
               echo "location.assign('login.php');</script>";
            }
        }
//    }
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CASH MEMO</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
    </head>
    <style> 
#selected{
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
                    <div class="body_heading">Please Log In</div>
                    <form method="POST">
                        <?php if($loginlock) { ?>
                        <div class="login">You failed 3 times to log in. Wait <?php echo $remainminute; echo ($remainminute > 1)? " minutes ": " minute "; ?>to log in again.</div>
                        <?php } else { ?>
                        <input type="text" name="username" value="" maxlength="20" required placeholder="Enter User Name" title="User Name" /><br>
                        <input type="password" name="password" value="" required placeholder="Enter Password" title="Password" /><br>
                        <input type="submit" value="Log In" name="login" class="submit_button" />
                        <?php } ?>
                    </form>
                </div>
            </div>
            
            <div class="footer">
            <?php include("design_footer.php");?>
            </div>
        </div>
    </body>
</html>
