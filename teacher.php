<?php
<<<<<<< HEAD
if(isset($_COOKIE['teacher']) && $_COOKIE['teacher']==1){

}
else{
    die("<b>you can not access this page</b>");
}
include ("nav.php");
=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
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
<<<<<<< HEAD
                        <td><input type="text" readonly name="name[]" value="<?php echo $row['fullname'];?>"></td>
                        <td><input type="text" readonly name="email[]" value="<?php echo $row['email'];?>"</td>
                        <td><input type="text" readonly name="class[]" value="<?php echo $row['class'];?>"</td>
=======
                        <td><input type="text" name="name[]" value="<?php echo $row['fullname'];?>" readonly></td>
                        <td><input type="text" name="email[]" value="<?php echo $row['email'];?>" readonly</td>
                        <td><input type="text" name="class[]" value="<?php echo $row['class'];?>" readonly</td>
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
                        <td><input type="radio" value="present" name="present[<?php echo $i; ?>]" checked></td>
                        <td><input type="radio" value="absent" name="present[<?php echo $i; ?>]"></td>
                    </tr>


                <?php $i++;
                }
            }
            ?>
<<<<<<< HEAD
                <input type="number" id="session" name="sessionVal" placeholder="Session Value i.e 1" required><br>
=======
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
                <input id="submitAttendance" type="button" class="btn btn-success" value="Submit Attendance" name="submitAttendance">
            </form>
            </tbody>

        </table>
    </div>
</div>
<<<<<<< HEAD
    <script>


        $("#submitAttendance").click(function(){

            if($("#session").val().length==0){
                alert("session is required");
            }
            else{
                $.cookie("sessionVal", $("#session").val());
                var data = $('form#attendanceForm').serialize();
                $.ajax({
                    url: 'save-attendance.php',
                    method: 'post',
                    data: {formData: data},
                    success: function(data){
                        console.log(data);
                        alert("success");
                    }
                });
            }
=======
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
>>>>>>> a0d5860fa5408103ce79b8b6fa9ab23730e6f54f
        });
    </script>