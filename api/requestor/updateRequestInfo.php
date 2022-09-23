<?php
include '../../config.php';
date_default_timezone_set('Asia/Manila');
$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
        $details = json_decode(file_get_contents('php://input'));

      
        $type = $details->type;
        $id = $details->id;
        $value = $details->value;
        $date = date('Y-m-d H:i:s');

             
        $sql = "UPDATE `request` SET `$type` = ? WHERE PK_requestID =?;";
                $stmt = $db->prepare($sql);
        
                $stmt ->bind_param("ss",$value,$id);
                $stmt->execute();
               
        


        break;

}