<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
      
        $date = date('Y-m-d H:i:s');
        $id = $details->id;
        $request_stats = "ACCOMPLISHED";
        $status = 3;

       
        $query = " UPDATE `request` SET `status`=?,`request_status`=? ,`dt_accomplished` =? WHERE PK_requestID = ?";

        $stmt = $db->prepare($query);
        $stmt->bind_param("ssss",$status,$request_stats,$date,$id);
       
        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Request updated Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        } 
      
            echo json_encode($response);
        

        break;

}