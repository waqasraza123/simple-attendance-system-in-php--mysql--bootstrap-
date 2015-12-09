<?php
require("db-connect.php");
//get session count
$query = "SELECT * FROM attendance";
$result = $conn->query($query);
$sessionCount=0;
setcookie('sessionCount', ++$sessionCount);
if(mysqli_num_rows($result)>0){
    while($row = $result->fetch_assoc()){
        $sessionCount = $row['session'];
        setcookie('sessionCount', ++$sessionCount);
    }
}

$query = "SELECT * FROM user WHERE role='student'";
$result = $conn->query($query);
?>
<div class="panel panel-primary">
    <div class="panel-heading"><h2>Take Attendance</h2></div>
    <div class="panel-body">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Class</th>
                <th>P</th>
                <th>A</th>
            </tr>
            </thead>
            <tbody>
            <form action="" id="attendanceForm">
            <?php
            if(mysqli_num_rows($result)>0){
                $i=0;
                while($row = $result->fetch_assoc()){

                    ?>
                    <tr>
                        <input type="hidden" value="<?php echo($row['id']);?>">
                        <td><input type="text" name="name[]" value="<?php echo $row['fullname'];?>" readonly></td>
                        <td><input type="text" name="email[]" value="<?php echo $row['email'];?>" readonly</td>
                        <td><input type="text" name="class[]" value="<?php echo $row['class'];?>" readonly</td>
                        <td><input type="radio" value="present" name="present[<?php echo $i; ?>]" checked></td>
                        <td><input type="radio" value="absent" name="present[<?php echo $i; ?>]"></td>
                    </tr>


                <?php $i++;
                }
            }
            ?>
                <input id="submitAttendance" type="button" class="btn btn-success" value="Submit Attendance" name="submitAttendance">
            </form>
            </tbody>

        </table>
    </div>
</div>
    <script>$("#submitAttendance").click(function(){
            var data = $('form#attendanceForm').serialize();
            $.ajax({
                url: 'save-attendance.php',
                method: 'post',
                data: {formData: data},
                success: function(data){
                    console.log(data);
                    alert(data);
                }
        });
        });
    </script>