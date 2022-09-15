<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'GET':
     
			$query = " SELECT * FROM `worktype` ";
            $result = mysqli_query($db,$query); 

            while($row = mysqli_fetch_array($result)){
           
                    $data[] = $row;
              
             } 
            echo json_encode($data);
        break;
}