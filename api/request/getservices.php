<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
     
			$query = " SELECT * FROM `services` ";
            $result = mysqli_query($db,$query); 

            while($row = mysqli_fetch_array($result)){
                    $data[] = $row;
             } 
            echo json_encode($data);
        break;
        case 'GET':
        echo $_GET['fname'].' '.$_GET['lname'];
        break;
}