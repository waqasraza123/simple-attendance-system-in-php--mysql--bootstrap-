<?php
require("db-connect.php");
if(isset($_COOKIE['login'])){
    $currentUser = $_COOKIE['currentUser'];
}
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
        </table>
    </div>
</div>