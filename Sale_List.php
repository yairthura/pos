<!-- <?php
    session_start();
    date_default_timezone_set("Asia/Rangoon");
    require_once "./db_connect.php";
    if(isset($_GET["deleteid"])) {
        $statement = $connection->prepare("DELETE FROM staff_bio WHERE staffid = ?");
        $statement->bind_param("i", $_GET["deleteid"]);
        if($statement->execute()) {
            //unlink("leopard_img/" . $_GET["img"]);
            echo "<script>alert('Success delete.');location.assign('Staff_Bio_List.php');</script>";
        }
        else {
            $err = htmlspecialchars($statement->error);
            echo "<script>alert('$err');</script>";
        }
        $statement->close();
    }
    if(isset($_GET["updateid"])) {
        $_SESSION["sid"] = $_GET["updateid"];
        header("Location: Staff_Bio.php");
    }

    $result = $connection->query("SELECT * FROM staff_bio");
    $staffall = $result->fetch_all();
    $result->free();
?> -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>CASH MEMO</title>
        <link href="styles.css" rel="stylesheet" type="text/css"/>
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
                <div class="bodydata" style="width: 980px; margin-left: 10px;">
                    <div class="body_heading">ဝယ်ယူသူများ၏အချက်အလက်မှတ်တမ်းများ</div>
                    <form method="POST">
                        <?php if(!isset($_SESSION["adminid"])) { ?>
                        <div class="login">You are not log in. Please log in to gain access on ADMIN site.</div>
                        <?php } else { ?>
                        <table border="1" class="leopard_table">
                            <tr><th>အမှတ်စဉ်</th><th>ဝယ်ယူသူအမည်</th><th>ဝယ်ယူသူ Email လိပ်စာ</th><th>ဝယ်ယူသူကိုယ်ပိုင်အမည်</th><th>ဝယ်ယူသည့်နေ့စွဲ</th><th>ဝယ်ယူသူလိပ်စာ</th><th>ဝယ်ယူသည့်ပစ္စည်းအမျိုးအမည်</th>
                                <th>ဝယ်ယူသည့်အရေအတွက်</th><th>ဈေးနှုန်း</th><th>ကျသင့်ငွေ</th><th>စုစုပေါင်းကျသင့်ငွေ</th><th>Update</th><th>Delete</th></tr>
                            <?php
                                for($row = 0; $row < count($staffall); $row++) {
                                    $record = $staffall[$row];
                                  echo "<tr><td>$record[0]</th><td>$record[1]</td><td>$record[2]</td><td>$record[3]</td>";
                                    echo "<td>$record[4]</div></td><td>$record[5]</td><td>$record[6]</td><td>$record[7]</td><td>$record[8]</td><td>$record[9]</td><td>$record[10]</td>";
                                    echo "<td><a href='Staff_Bio_List.php?updateid=$record[0]'>Update</a></td>";
                                    echo "<td><a href='Staff_Bio_List.php?deleteid=$record[0]'>Delete</a></td></tr>";
                                }
                            ?>
                        </table>
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
