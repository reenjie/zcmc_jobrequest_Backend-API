<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

        $notedby = $details->notedby;
        $id = $details->requestid;
        $dremarks = $details->dremarks;
        $date = date('Y-m-d H:i:s');

             
        $sql = "UPDATE `request` SET `notedby` = ? , `dtapproved`= ?,`disapproved_remarks`=? ,`status`=5,`request_status`='DISAPPROVED'  WHERE PK_requestID =?";
                $stmt = $db->prepare($sql);
        
                $stmt ->bind_param("ssss",$notedby,$date,$dremarks,$id);
                if($stmt->execute()){
                    $response =  ['status'=> 1,'message'=>'Request Approved Successfully.'];
                }
               
                echo json_encode($response);



        break;

}