<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $id = $details->userID;
        $isset = 1;
        $date = date('Y-m-d H:i:s');

        $query = "select * from request where FK_userID =? and isset = 0";

        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();  
      
        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $requestid = $row['PK_requestID'];

                $update = "UPDATE `request` SET `isset`=?,`updated_at`=? WHERE PK_requestID = ?";
                $stmt = $db->prepare($update);
                $stmt->bind_param("sss",$isset,$date,$requestid);
                $stmt->execute();
                $response = ['status'=> 1,'message'=>'Request submit Successfully.'];

            }
        }

           echo json_encode($response);
         

        break;

}