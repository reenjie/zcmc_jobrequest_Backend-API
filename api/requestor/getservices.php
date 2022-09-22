<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
        $data = [];
			$query = " SELECT * FROM `services` where PK_servicesID in (select FK_serviceID from services_offer) ORDER by created_at desc; ";
            $result = mysqli_query($db,$query); 

            while($row = mysqli_fetch_array($result)){
           
                    $data[] = $row;
              
             } 

            echo json_encode($data);
         

        break;

}