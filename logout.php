<?php
    session_start();
    session_destroy();
    echo "<script>alert('Success Log Out.');location.assign('index.php');</script>";