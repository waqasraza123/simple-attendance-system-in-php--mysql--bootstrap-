<?php
$pageTitle = 'Attendance Report';
include('header.php');
require("db-connect.php");
if (isset($_COOKIE['teacher']) && $_COOKIE['teacher'] == 1 && isset($_COOKIE['login'])) {
    // Nothing to do - just keep on truckin'.
} else { // Not a teacher? You're out of here.
    $conn->close();
    echo 'Only teachers can view the Attendance Report.';
    include('footer.php');
    exit;
}

$currentUser = $_COOKIE['currentUser'];

$currentUserId = (isset($_COOKIE['loginId']))? $_COOKIE['loginId'] : 1;

$studentAttendanceQuery = "SELECT (session) FROM `attendance` group by (session)";
$totalAttendance = (mysqli_num_rows($conn->query($studentAttendanceQuery)));

$studentAttendanceQuery = "SELECT (isPresent) FROM attendance where (studentid=".$currentUserId." and isPresent='present')";
$studentAttendance =  (mysqli_num_rows($conn->query($studentAttendanceQuery)));

$query = "select distinct fullname, email, class, session, isPresent from attendance join user on attendance.studentid = user.id join class on attendance.classid = class.id where user.email='".$currentUser."'";
$result = $conn->query($query);

?>
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
    <div class="bg-success"><h2><?php echo (empty($totalAttendance)?"100":($studentAttendance/$totalAttendance*100))."%";?></h2></div>

</table>
<?php
include('footer.php');