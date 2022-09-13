<?php
include '../../config.php';

$method = $_SERVER['REQUEST_METHOD'];

switch ($method) {
    case 'POST':
            
        $data = [];
        
			$query = " SELECT * FROM `users` where isverified =0 ";
            $result = mysqli_query($db,$query); 

            while($row = mysqli_fetch_array($result)){
           
                    $data[] = $row;
              
             } 

           
                echo json_encode($data);
             

           
         

        break;

}