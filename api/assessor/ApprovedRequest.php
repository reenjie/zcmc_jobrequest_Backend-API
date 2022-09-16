<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $id = $details->id;
        $prioritization = $details->prioritization;
        $typeofrepair = $details->typeofrepair;
        $recommendation = $details->recommendation;
        $status=2;

        echo $id.$prioritization.$typeofrepair.$recommendation;


        $query = " UPDATE `request` SET `status`=?,`prioritization`=?,`typeofrepair`=?,`recommendation`=?  WHERE PK_requestID = ?";

        $stmt = $db->prepare($query);
        $stmt->bind_param("sssss",$status,$prioritization,$typeofrepair,$recommendation,$id);
       
        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Request Approved Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }
     
            echo json_encode($response);
        

        break;

}