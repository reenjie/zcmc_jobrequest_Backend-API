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
        $year = $details->years;
        $months=$details->months;
        $weeks=$details->weeks;
        $days = $details->days;
        $status=2;
        $date = date('Y-m-d H:i:s');
        $request_status = "WORK ON GOING";
        $message = "Currently Working";
       


        $query = " UPDATE `request` SET `status`=?,`prioritization`=?,`typeofrepair`=?,`recommendation`=?, `dt_assessed`=?,`tf_years`=?,`tf_months`=?,`tf_weeks`=?,`tf_days`=? ,
         `request_status`=? ,`status_message`=?  WHERE PK_requestID = ?";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssssssssssss",$status,$prioritization,$typeofrepair,$recommendation,$date,$year,$months,$weeks,$days,$request_status,$message,$id);
       
        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'Request Approved Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }
     
            echo json_encode($response);
        

        break;

}