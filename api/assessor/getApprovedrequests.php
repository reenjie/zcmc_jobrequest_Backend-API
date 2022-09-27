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
        request.FK_workID,
        request.FK_serviceID,
        request.prioritization,
        request.typeofrepair,
        request.recommendation,
       request.FK_serviceOfferID,
       request.request_status,
       request.notedby,
       request.dtapproved,
       request.status_message,
       request.others,
       request.findings,
       request.materials_needed,
       request.estimated_unitcost,
       request.total_estimated_cost,
       request.remarks,
       request.dt_assessed,
       request.repairedby,
       request.accomplishment_remarks,
       request.assessedby,
       request.disapproved_remarks,
       request.tf_years,    
       request.tf_months,
       request.tf_weeks,
       request.tf_days,
       request.status,
       request.isset,
       request.dtstart,
       request.dtend,
       (request.tf_years * 365 + request.tf_months*31 + request.tf_weeks * 7 + request.tf_days) as totaldays,
        request.status
        from
        users INNER JOIN request on users.PK_userID = request.FK_userID  or request.FK_serviceOfferID = NULL 
        INNER JOIN worktype on worktype.PK_workTypeID = request.FK_workID  
        where
        request.FK_serviceID = ? and request.status in (2,4) and request.isset=1 ORDER BY totaldays asc";

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