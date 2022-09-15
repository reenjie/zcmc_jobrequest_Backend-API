<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
      $details = json_decode(file_get_contents('php://input'));

      //$user =  $details->fname.' '.$details->lname;
         $status = ['status' => 1, 'message' => 'Record Updated Successfully'];
      echo json_encode($status);
        break;
        
		/* 	$gettabledata = " SELECT * FROM `promos` ";
            $gettingcategories = mysqli_query($con,$gettabledata); 
            $cat_count= mysqli_num_rows($gettingcategories);
           //  $get_id =  mysqli_insert_id($con); 
        
        
             while($row = mysqli_fetch_array($gettingcategories)){

             } */
     case 'GET':
        
        echo $_GET['fname'].' '.$_GET['lname'];
        break;
}