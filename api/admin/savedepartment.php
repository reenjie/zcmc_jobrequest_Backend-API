<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));


        
        $sql = "INSERT INTO `department`( `dept_name`, `ward_sec_unit`, `created_at`, `updated_at`) VALUES (?,?,?,?)";
        $stmt = $db->prepare($sql);

        
        $name = $details->dname;
        $wsu = $details->wsu;
        $date = date('Y-m-d H:i:s');
        $stmt ->bind_param("ssss",$name,$wsu,$date,$date);

        if($stmt->execute()){
            $response = ['status'=> 1,'message'=>'New Department Added Successfully.'];
        }else {
            $response = ['status'=> 0,'message'=>'Failed to Save.'];
        }

       
        echo json_encode($response);
        break;

}