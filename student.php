<?php
<<<<<<< HEAD

if(isset($_COOKIE['student']) && $_COOKIE['student']==1){

}
else{
    die("<b>you can not access this page</b>");
}

include ("nav.php");
=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
require("db-connect.php");
if(isset($_COOKIE['login'])){
    $currentUser = $_COOKIE['currentUser'];
}
<<<<<<< HEAD

$currentUserId = (isset($_COOKIE['loginId']))? $_COOKIE['loginId'] : 1;

$studentAttendanceQuery = "SELECT (session) FROM `attendance` group by (session)";
$totalAttendance = (mysqli_num_rows($conn->query($studentAttendanceQuery)));

$studentAttendanceQuery = "SELECT (isPresent) FROM attendance where (studentid=".$currentUserId." and isPresent='present')";
$studentAttendance =  (mysqli_num_rows($conn->query($studentAttendanceQuery)));


=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
$query = "select distinct fullname, email, class, session, isPresent from attendance join user on attendance.studentid = user.id join class on attendance.classid = class.id where user.email='".$currentUser."'";
$result = $conn->query($query);

?>

<div class="panel panel-primary">
    <div class="panel-heading"><h1>Attendance</h1></div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>Session</th>
                <th>Attendance</th>
            </tr>
            </thead>
            <tbody>
            <?php
            if(mysqli_num_rows($result) > 0){
                while($row = $result->fetch_assoc()){ ?>
                    <tr>
                        <td><?php echo $row['fullname'];?></td>
                        <td><?php echo $row['email'];?></td>
                        <td><?php echo $row['class'];?></td>
                        <td><?php echo $row['session'];?></td>
                        <td><?php echo (($row['isPresent']));?></td>
                    </tr>
                <?php }
            }
            ?>

            </tbody>
<<<<<<< HEAD
            <div class="bg-success"><h2><?php echo (($studentAttendance/$totalAttendance)*100)."%";?></h2></div>
=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
        </table>
    </div>
</div>