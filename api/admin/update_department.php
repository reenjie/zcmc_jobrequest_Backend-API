<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

        $name = $details->dname;
        $wsu = $details->wsu;
        $id = $details->id;
        $date = date('Y-m-d H:i:s');

             
        $stmt = $db->prepare("SELECT * FROM department WHERE PK_departmentID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $dname = $row['dept_name'];
                $dwsu  = $row['ward_sec_unit'];

              if($dname == $name && $wsu == $dwsu){
                $response = ['status'=> 2,'message'=>'No changes'];
              }else if($dname == $name || $wsu == $dwsu) {
                $sql = "UPDATE `department` SET `dept_name`=?,`ward_sec_unit`=?,`updated_at`=? WHERE `PK_departmentID` = ?";
                $stmt = $db->prepare($sql);
        
                $stmt ->bind_param("ssss",$name,$wsu,$date,$id);
        
                if($stmt->execute()){
                    $response = ['status'=> 1,'message'=>'New Department Added Successfully.'];
                }else {
                    $response = ['status'=> 0,'message'=>'Failed to Save.'];
                }
        
               
               
              }


            }
            echo json_encode($response); 
        }


        break;

}