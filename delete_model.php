<?php
require_once './database/database.php';
    echo ($_GET['id']);
    if(deleteStudent($_GET['id'])){
        header('location: index.php');
    };
    

    // echo '<script>window.loacation.reload();</script>';
    // exit();
