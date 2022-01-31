<?php
session_start();
date_default_timezone_set("Asia/Rangoon");
require_once "./db_connect.php";
if(isset($_POST["btn"])){


$search = $_POST['search'];

$q = " SELECT invoiceID,date,quantity,price,amount,clientID,itemID,itemName,staffName FROM invoice where date LIKE '%".$search."%'";
$query = $connection->query($q);
$search_data = $query->fetch_all();

function filterData(&$str)
{
    $str = preg_replace("/\t/", "\\t", $str);
    $str = preg_replace("/\r?\n/", "\\n", $str);
    if (strstr($str, '"'))
        $str = '""' . str_replace('""', '""', $str) . '""';
}


// Excel file name for download

$fileName = "data_list-" . date('Ymd') . ".xlsx";

//Column names

$fields = array('No','InvoiceID', 'Date', 'Quantity', 'Price', 'Amount', 'ClientID', 'ItemID', 'Item Name', 'Staff Name');

//Display column names as first row
$excelData = implode("\t", array_values($fields)) . "\n";

if ($query->num_rows > 0) {
    $i = 0;
  //  while ($row = $query->fetch_assoc()) {
    foreach ($search_data  as $row){
        $i++;

        $rowData = array(
            $i, $row[0], $row[1], $row[2], $row[3], $row[4], $row[5], $row[6], $row[7], $row[8]);
        array_walk($rowData, 'filterData');
        $excelData .= implode("\t",array_values($rowData)) . "\n";
    }
    }else {
        $excelData .= 'No records found.....' . "\n";
    }

//Header for download
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="data.xlsx"');

 
//Render excel data
echo $excelData;

exit;
}



$q = " Select * FROM invoice ";
$query = $connection->query($q);

?>

<!DOCTYPE html>
<html>
    <head>
        <title></title>
        <link rel="stylesheet" href="CSS /bootstrap.css">
        <style> 
#selected7{
  color: red;

}
div#div {
    height: 50px;
    padding: 10px 5px 0 5px;
}
div#div1 {
    float: right;
}

</style>
    </head>
    <body>
    <form action="<?php $_PHP_SELF?>" method="POST">
    <div id="div">
        <button  class="btn btn-success" name="btn" title="Click to export" style="width:80px;height:40px;">Export</button> 
      <div id="div1"><input type="text" name="search" placeholder="yyy-mm-dd" required>
        <input type="submit" value="Search" name="submit" class="btn btn-success"  style="width:80px;height:40px;">
        </div>
    </div>


    <table class="table ">
        <thead>
              <tr>
                  <th>No</th>
                <th>
                  Invoice ID
                </th>
                <th>
                  Date
                </th>
                <th>
                  Quantity
                </th>
                <th>
                  Price
                </th>
                <th>
                  Amount
                </th>
                <th>
                                 ClientID
                            </th>
                            <th>
                                 ItemID
                            </th>
                            <th>
                                ItemName
                            </th>
                            <th> 
                                 StaffName
                            </th>

              </tr>
        </thead>
        <tbody>

  
            <?php 

if(isset($_POST["submit"])){
    $search = $_POST['search'];
    $q = " SELECT invoiceID,date,quantity,price,amount,clientID,itemID,itemName,staffName FROM invoice where date LIKE '%".$search."%'";
$query = $connection->query($q);
$search_data = $query->fetch_all();


            if($query -> num_rows > 0){
                $i=0;

                foreach ($search_data  as $row){
               // while($row = $query->fetch_assoc()){
                    $i++;
                    
 echo  "<tr><td>".$i."</td><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td>".$row[6]."</td><td>".$row[7]."</td><td>".$row[8]."</td>";
      

?>
<?php 
                }
            }else{
                ?>
                <tr><td colspan="6">No data found.....</td></tr>
                <?php
            }
        }
?>

           
            
        </tbody>
    </table>
    </form>    </body>
</html>
