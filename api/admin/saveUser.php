<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

       
        
       $sql = "INSERT INTO `users`(`firstname`, `lastname`, `email`, `contact_no`, `address`, `user_type`,
         `fl`, `FK_departmentID`,  `specialty`, `position`, `FK_servicesID`, `created_at`, `updated_at`, `isverified`) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $stmt = $db->prepare($sql);


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

      
        
        $date = date('Y-m-d H:i:s');
        $stmt ->bind_param("ssssssssssssss",$firstname,$lastname,$email,$contactno,$address,$usertype,$fl,$department,$specialty,$position,$services,$date,$date,$isverified);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'User Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }
 


       
        echo json_encode($response); 
        break;

}