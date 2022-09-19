<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));
        $id = $details->serviceID;
       
       $query = "SELECT 
        request.PK_requestID,
  		request.FK_userID,
        users.firstname,
        users.lastname,
        users.email,
        users.contact_no,
        worktype.label,
        request.FK_serviceOfferID,
        request.others,
        request.status
        from
        users INNER JOIN request on users.PK_userID = request.FK_userID  or request.FK_serviceOfferID = NULL 
        INNER JOIN worktype on worktype.PK_workTypeID = request.FK_workID  
        where
        request.FK_serviceID = ? and request.status= 3; ";

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