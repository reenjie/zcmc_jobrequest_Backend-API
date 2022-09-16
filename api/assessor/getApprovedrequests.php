<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $id = $details->serviceID;
        $query = " SELECT * FROM `request` where FK_serviceID=? and status = 2 ";

        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $id);
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