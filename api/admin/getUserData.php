<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));

       $id =  $details->userid;

		$query = " SELECT * FROM `users` where PK_userID=? ";

        $stmt = $db->prepare($query);
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $data[]=$row;
            }
        }

            echo json_encode($data);
         

        break;

}