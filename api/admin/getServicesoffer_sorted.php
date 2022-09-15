<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $details = json_decode(file_get_contents('php://input'));

        $id = $details->serviceid;
       
        $stmt = $db->prepare("SELECT * FROM `services_offer` WHERE FK_serviceID = ? ORDER by created_at desc; ");
        $stmt->bind_param("s", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        $data = [];
        if(mysqli_num_rows($result) > 0) {
            while($row = $result->fetch_assoc()) {
                $data[] = $row;

            }
            echo json_encode($data); 
        }
          

        break;

      


}




    
/* $id = $_GET['serviceId'];
$query = " SELECT * FROM `services_offer` where FK_servicesID = '.$id.' ";
$result = mysqli_query($db,$query); 

while($row = mysqli_fetch_array($result)){

        $data[] = $row;
  
 } 

echo json_encode($data); */
