<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));
 
        $id = $details->id;
        $date = date('Y-m-d H:i:s');
        $isverified = 1;

        $sql = "UPDATE `users` SET `isverified`=?,`updated_at`=? WHERE `PK_userID` = ?";
        $stmt = $db->prepare($sql);

        $stmt ->bind_param("sss",$isverified,$date,$id);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Service Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }
           
           
            echo json_encode($response); 
        


        break;

}