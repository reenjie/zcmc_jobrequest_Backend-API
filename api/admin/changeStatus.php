<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

      
        $id = $details->id;
        $status = $details->s_status;
        $date = date('Y-m-d H:i:s');

       
      $sql = "UPDATE `services` SET `isSM`= ? WHERE `PK_servicesID` = ?";
        $stmt = $db->prepare($sql);

        $stmt ->bind_param("ss",$status,$id);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Service status Updated Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }

            
            echo json_encode($response); 
        

        break;

}