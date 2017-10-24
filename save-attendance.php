<?php
//include ("nav.php");
require("db-connect.php");

$query = "SELECT * FROM user WHERE role='student'";
$result = $conn->query($query);

$nameArray  = Array();

$count = mysqli_num_rows($result);

if(isset($_COOKIE['sessionCount'])){
    $sessionCount = $_COOKIE['sessionCount'];
}

//save record to db
if(isset($_POST['formData'])) {

    //increment the session count
    if(isset($_COOKIE['sessionCount'])){
        $sessionCount = $_COOKIE['sessionCount'];
        setcookie('sessionCount', ++$sessionCount);
    }

    parse_str($_POST['formData'], $searcharray);
    //print_r($searcharray);die;
    //print_r($_POST);

    for ($i = 0 ; $i < sizeof($searcharray) ; $i++){
    //    setcookie("checkloop", $i);;
        $name = $searcharray['name'][$i];
        $email=   $searcharray['email'][$i];
        $class =  $searcharray['class'][$i];
        $present= $searcharray['present'][$i];
            if(isset($_COOKIE['sessionVal'])){
                $sessionVal = $_COOKIE['sessionVal'];
            }

            //get class id
            $class_query = "SELECT * FROM class WHERE name='".$class."'";
            $class_id = mysqli_query($conn, $class_query);

            if($class_id){
                echo "I am here";
                while($class_id1 = $class_id->fetch_assoc()){
                    $class_id_fin = $class_id1['id'];
                    echo $class_id['id'];
                }
            }
            else{
                echo "Error: " . $class_query . "<br>" . mysqli_error($conn);
            }

            //get student id
            $student_query = "SELECT * FROM user WHERE email='".$email."'";
            $student_id = $conn->query($student_query);
            if($student_id) {
                while ($student_id1 = $student_id->fetch_assoc()) {
                    $student_id_fin = $student_id1['id'];
                }
            }

            //insert or update the record
            $query = "INSERT INTO attendance VALUES ( '".$class_id_fin."', '".$student_id_fin."' , '".$present."','".$sessionVal."','comment')
             ON DUPLICATE KEY UPDATE isPresent='".$present."'";

            print_r($query);

            if(mysqli_query($conn, $query)){
                echo json_encode(array('status' => 'success', 'message' => 'Attendance added!'));
            } else{
            echo json_encode(array('status' => 'error', 'message' => 'Error: ' . $query . '<br>' . mysqli_error($conn)));
            }
    }
    $conn->close();
}