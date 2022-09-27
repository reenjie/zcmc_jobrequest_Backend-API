<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));
     

        
        $sql = "INSERT INTO `status_message`( `FK_requestID`, `message`,`created_at`) VALUES (?,?,?)";
        $stmt = $db->prepare($sql);

        
        $message = $details->status_message;
        $id = $details->id;
        $date = date('Y-m-d H:i:s');
        $stmt ->bind_param("sss",$id,$message,$date);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'statusmessage Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }

       
        echo json_encode($response);
        break;

}