<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $query = "SELECT * FROM `status_message` order by created_at desc";

   
        $stmt = $db->prepare($query);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $data[]=$row;
            }
        }

            echo json_encode($data);
         

        break;

}