<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

      
        $usertype = $details->usertype;
        $firstname = $details->firstname;
        $lastname = $details->lastname;
        $email = $details->email;
        $contactno = $details->contactno;
        $address = $details->address;
        $department = $details->department;
        $specialty = $details->specialty;
        $position = $details->position;
        $services = $details->services;
        $fl = 0;
        $isverified=1;
        $id = $details->id;

        $date = date('Y-m-d H:i:s');

             
        $sql = "UPDATE `users` SET `firstname`=?,`lastname`=?,
                `email`=?,`contact_no`=?,`address`=?,`user_type`=?,`FK_departmentID`=?,
                `specialty`=?,`position`=?,`FK_servicesID`=?,`updated_at`=? WHERE PK_userID=?";
                $stmt = $db->prepare($sql);
        
                $stmt ->bind_param("ssssssssssss",$firstname,$lastname,$email,$contactno,$address,$usertype,$department,$specialty,$position,$services,$date,$id);
        
                if($stmt->execute()){
                    $response = ['status'=> 1,'message'=>'Account Updated Successfully.'];
                }else {
                    $response = ['status'=> 0,'message'=>'Failed to Save.'];
                }
       
            echo json_encode($response); 
        


        break;

}