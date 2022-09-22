<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];


switch ($method) {
    case 'POST':
        
        $details = json_decode(file_get_contents('php://input'));
        $id= $details->id;
      
       
            
         $sql = "DELETE FROM `request` WHERE PK_requestID=? ";
            $stmt = $db->prepare($sql);
            $stmt ->bind_param("s",$id);
            if($stmt->execute()){
                $response = ['status'=> 1,'message'=>'Department Deleted Successfully.'];
            }else {
                $response = ['status'=> 0,'message'=>'Failed to Delete.'];
            } 
          
            echo json_encode($response);
     
    
 


     
         

        break;

}
