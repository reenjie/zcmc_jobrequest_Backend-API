<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $id = $details->id;
     

                $update = "DELETE from  `request` WHERE PK_requestID = ?";
                $stmt = $db->prepare($update);
                $stmt->bind_param("s",$id);
                if($stmt->execute()){
                     $response = ['status'=> 1,'message'=>'Request Deleted Successfully.'];
                }
               


           echo json_encode($response);
         

        break;

}