<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));


        
        $sql = "INSERT INTO `services_offer`(`name`, `FK_serviceID`, `created_at`, `updated_at`) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);

        
        $name = $details->services;
        $id = $details->serviceid;

        $date = date('Y-m-d H:i:s');
        $stmt ->bind_param("ssss",$name,$id,$date,$date);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Services Offers Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }

       
        echo json_encode($response); 
        break;

}