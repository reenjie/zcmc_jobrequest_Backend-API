<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));
     

        
        $sql = "DELETE from  `status_message` where PK_statusID = ? ";
        $stmt = $db->prepare($sql);

        
      
        $id = $details->id;
        $stmt ->bind_param("s",$id);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'status_message Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }

       
        echo json_encode($response);
        break;

}