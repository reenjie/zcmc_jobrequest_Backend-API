<?php

    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Headers: *');

    $db =mysqli_connect('localhost','root','','zcmc_joborderrequest');
    if($db === false){
        die("ERROR : Could not Connect.".mysqli_connect_error());
    }
    
?>
