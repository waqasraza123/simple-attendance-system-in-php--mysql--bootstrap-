<?php
<<<<<<< HEAD
include ("nav.php");
=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
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

<<<<<<< HEAD
=======

>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
    parse_str($_POST['formData'], $searcharray);
    //print_r($searcharray);
    //print_r($_POST);

<<<<<<< HEAD
        for ($i = 0 ; $i < sizeof($searcharray) ; $i++){
            setcookie("checkloop", $i);
=======
        for ($i = 0 ; $i <= sizeof($searcharray) ; $i++){
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
            $name = $searcharray['name'][$i];
            $email=   $searcharray['email'][$i];
            $class =  $searcharray['class'][$i];
            $present=  ($searcharray['present'][$i]);
<<<<<<< HEAD
            if(isset($_COOKIE['sessionVal'])){
                $sessionVal = $_COOKIE['sessionVal'];
            }
=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f

            //get class id
            $class_query = "SELECT * FROM class WHERE name='".$class."'";
            $class_id = mysqli_query($conn, $class_query);

            if($class_id){
                echo "I am here";
                while($class_id1 = $class_id->fetch_assoc()){
                    $class_id_fin = $class_id1['id'];
                    //echo $class_id['id'];
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

<<<<<<< HEAD
            //insert or update the record
            $query = "INSERT INTO attendance VALUES ( '".$class_id_fin."', '".$student_id_fin."' , '".$present."','".$sessionVal."','comment')
             ON DUPLICATE KEY UPDATE isPresent='".$present."'";

            print_r($query);
=======
            $query = "INSERT INTO attendance VALUES ( '".$class_id_fin."', '".$student_id_fin."' , '".$present."','".$sessionCount."','comment')";
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f

            if(mysqli_query($conn, $query)){
                echo "success";
            }
            else{
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }

    $conn->close();
}