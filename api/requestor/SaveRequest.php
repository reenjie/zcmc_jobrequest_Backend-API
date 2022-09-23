<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $selectedID = $details->selected;
        $typeofwork = $details->typeofWork;
        $userid = $details->userID;
        $status = 0;
        $isset = 0;
        date_default_timezone_set('Asia/Manila');
        $date = date('Y-m-d H:i:s');

        //Fetch Selected ID's
        foreach ($selectedID as $key => $serviceOfferid) {
           // echo $serviceOfferid;

             $getServiceoffer="SELECT * FROM `services_offer` where PK_soID = ? ";
                $stmt = $db->prepare($getServiceoffer);
                $stmt->bind_param("s", $serviceOfferid);
                $stmt->execute();
                $result = $stmt->get_result();
                if(mysqli_num_rows($result) > 0) {
                    while($row = $result->fetch_assoc()) {
                      $servicesid =  $row['FK_serviceID'];

                      /* Save Temporary Request */
                            
                        $check = "SELECT * from `services` where PK_servicesID=?";
                        $stmt = $db->prepare($check);
                        $stmt->bind_param("s", $servicesid);
                        $stmt->execute();
                        $checkresult = $stmt->get_result();
                        if(mysqli_num_rows($checkresult) > 0) {
                            while($serv = $checkresult->fetch_assoc()) {
                                 $isSM = $serv['isSM'];

                                 if($isSM == 1){
                        $saveRequest = "INSERT INTO `request`(
                                        `FK_userID`, `FK_workID`, 
                                        `FK_serviceID`, `FK_serviceOfferID`,
                                        `status`, `isset`,
                                        `created_at`, `updated_at`) 
                                        VALUES (?,?,?,?,?,?,?,?)";
                                          $stmt = $db->prepare($saveRequest);
                                          $stmt->bind_param("ssssssss", $userid,$typeofwork,$servicesid,$serviceOfferid,$status,$isset,$date,$date);
                                          if( $stmt->execute()){
                                            $response = ['status'=> 1,'message'=>'Request saved Successfully.'];
                                          }
                                      
                                 }else {
                                        $checkRequest = "select * from request where FK_userID =? and FK_workID=? and FK_serviceID =? and FK_serviceOfferID=? and isset in (0,1) and status in (0,1,2) ";
                                        $stmt = $db->prepare($checkRequest);
                                        $stmt->bind_param("ssss",$userid,$typeofwork,$servicesid,$serviceOfferid);
                                        $stmt->execute();
                                        $checkREquestresult = $stmt->get_result();
                                        if(mysqli_num_rows($checkREquestresult) >=1) {
                                            $response = ['status'=> 2,'message'=>'Cannot be saved.'];
                                        }else {
                                            $saveRequest = "INSERT INTO `request`(
                                                `FK_userID`, `FK_workID`, 
                                                `FK_serviceID`, `FK_serviceOfferID`,
                                                `status`, `isset`,
                                                `created_at`, `updated_at`) 
                                                VALUES (?,?,?,?,?,?,?,?)";
                                                  $stmt = $db->prepare($saveRequest);
                                                  $stmt->bind_param("ssssssss", $userid,$typeofwork,$servicesid,$serviceOfferid,$status,$isset,$date,$date);
                                                  if( $stmt->execute()){
                                                    $response = ['status'=> 1,'message'=>'Request saved Successfully.'];
                                                  }
                                              
                                        }


                                 }
                            }
                        }




              

                    }
                } 
        

        }

       echo json_encode($response);
    
        break;

}