<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));


        
        $sql = "INSERT INTO `services`( `name`,`created_at`, `updated_at`) VALUES (?,?,?)";
        $stmt = $db->prepare($sql);

        
        $name = $details->services;
        
        $date = date('Y-m-d H:i:s');
        $stmt ->bind_param("sss",$name,$date,$date);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'New Department Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }

       
        echo json_encode($response); 
        break;

}