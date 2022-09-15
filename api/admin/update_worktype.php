<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

        $name = $details->wt;
        $id = $details->id;
        $date = date('Y-m-d H:i:s');

             
        $stmt = $db->prepare("SELECT * FROM worktype WHERE PK_workTypeID = ?");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $sname = $row['label'];
              
              if($sname == $name){
                $response = ['status'=> 2,'message'=>'No changes'];
              }else {
                $sql = "UPDATE `worktype` SET `label`=?,`updated_at`=? WHERE `PK_workTypeID` = ?";
                $stmt = $db->prepare($sql);
        
                $stmt ->bind_param("sss",$name,$date,$id);
        
                if($stmt->execute()){
                    $response = ['status'=> 1,'message'=>'Service Added Successfully.'];
                }else {
                    $response = ['status'=> 0,'message'=>'Failed to Save.'];
                }
        
               
               
              }


            }
            echo json_encode($response); 
        }


        break;

}