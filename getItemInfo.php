<?php
require_once "./db_connect.php";

if(isset($_REQUEST['item'])){

  $re = $_REQUEST['item'];
  // connection should be on this page 
 
   $sql ="SELECT price FROM item where itemName = '$re'";
   

    
    $q = mysqli_query($connection,$sql) or  die( mysqli_error($connection));

    if($q == true){
    $res = mysqli_fetch_array($q);
    
    echo $res['price'];die;
    }

}


?>