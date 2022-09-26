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
        $repairedby = $details->repairedby;
        $remarks = $details->remarks;
        $dtstart = $details->dtstart;
        $dtend = $details->dtend;

       
        $query = " UPDATE `request` SET `status`=?,`request_status`=? ,`dt_accomplished` =?,`repairedby`=?,`accomplishment_remarks`=?,`dtstart`=?,`dtend`=? WHERE PK_requestID = ?";

        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssssss",$status,$request_stats,$date,$repairedby,$remarks,$dtstart,$dtend,$id);
       
        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Request updated Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        } 
      
            echo json_encode($response);
        

        break;

}