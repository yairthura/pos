<html>
    <head>   
      <style>
div.menu{
    height: 65px;
    padding-left: 100px;
    background-color:#4544442b;
    text-align: center;
    padding-top: 27px;

}

div.menuitem1{
    width: 200px;
    height: 35px;
    float: left;
 
    margin-left: 12px;
    font-family: cursive;
    font-size: 25px;
    line-height: 30px;
    text-align: center;
    border: solid 1px;
    color: black;
    background-color: white;


}
div.menuitem{
    width: 126px;
    height: 35px;
    float: left;
    font-family: cursive;
    font-size: 16px;
    line-height: 30px;
    text-align: center;

}

div.menuitem:hover{
    background-color: grey;
}



      </style>
    </head>
  
    <body>
    <div class="menu">
                <div class="menuitem1">
                    <img src="image/logo_img.jpg" class="logo_img"/><span>Techno City</span> </div>
                    <a href="login.php"><div class="menuitem" id="selected">Log In</div></a>
                    <a href="Sale.php"><div class="menuitem"  id="selected1">For Sale</div></a>
                    <a href="Repair.php"><div class="menuitem"  id="selected2">For Repair</div></a>
                    <a href="item_type.php"><div class="menuitem"  id="selected3">For Input Item</div></a>
                    <a href="aboutus.php"><div class="menuitem"  id="selected4">About Us</div></a>
                    <a href="staff.php"><div class="menuitem"  id="selected5">Staff</div></a>

                    <a href="logout.php"><div class="menuitem"  id="selected6">Log Out</div></a>
                    <a href="excel.php"><div class="menuitem"  id="selected7">List</div></a>
                </div>


           
    </body>
</html>