<?php
$pageTitle = 'Take Attendance';
include('header.php');
require("db-connect.php");
if(!(isset($_COOKIE['teacher']) && $_COOKIE['teacher']==1)){
    echo 'Only teachers can create new teachers and students.';
    $conn->close();
    include('footer.php');
    exit;
}
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

if(isset($_GET['class']) && !empty($_GET['class'])){
    $whichClass = $_GET['class'];
    $whichClassSQL = "AND class='" . $_GET['class'] . "'";
} else {
    $whichClass = '';
    $whichClassSQL = 'ORDER BY class';
}
    
echo '
    <div class="row">
        <div class="col-md-4">
            <div class="input-group">
                <input type="number" id="session" name="sessionVal" class="form-control" placeholder="Session Value i.e 1" required>
                <span class="input-group-btn">
                    <input id="submitAttendance" type="button" class="btn btn-success" value="Submit Attendance" name="submitAttendance">
                </span>
            </div>
        </div>
        <div class="col-md-8">
            <form method="get" action="' . $_SERVER['PHP_SELF'] . '" class="col-md-4">
                <select name="class" id="class" class="form-control" onchange="if (this.value) window.location.href=this.value">
';

// Generate list of classes.
$query = "SELECT DISTINCT class FROM user ORDER BY class;";
$classes = $classes = mysqli_query($conn, $query);
if($classes && mysqli_num_rows($classes)){
    // Get list of available classes.
    echo '    <option value="">Filter: Select a class</option>';
    echo '    <option value="?class=">All classes</option>';
    while($class = $classes->fetch_assoc()){
        echo '    <option value="?class=' . $class['class'] . '">' . $class['class'] . '</option>';
    }
} else {
    echo '    <option value="?class=" disabled>No classes defined.</option>';
}

echo '
                </select>
            </form>
        </div>
    </div>
';

$query = "SELECT * FROM user WHERE role='student' $whichClassSQL;";
$result = $conn->query($query);
?>
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Class</th>
            <th>Present</th>
            <th>Absent</th>
        </tr>
        </thead>
        <tbody>
        <form method="post" action="save-attendance.php" id="attendanceForm">
        <?php
        if(mysqli_num_rows($result) > 0){
            $i=0;
            while($row = $result->fetch_assoc()){

                ?>
                <tr>
                        <td><input type="hidden" value="<?php echo($row['id']);?>" form="attendanceForm"><input type="text" readonly="readonly" name="name[<?php echo $i; ?>]" value="<?php echo $row['fullname'];?>" form="attendanceForm"></td>
                        <td><input type="text" readonly="readonly" name="email[<?php echo $i; ?>]" value="<?php echo $row['email'];?>" form="attendanceForm"></td>
                        <td><input type="text" readonly="readonly" name="class[<?php echo $i; ?>]" value="<?php echo $row['class'];?>" form="attendanceForm"></td>
                        <td><input type="radio" value="present" name="present[<?php echo $i; ?>]" checked form="attendanceForm"></td>
                        <td><input type="radio" value="absent" name="present[<?php echo $i; ?>]" form="attendanceForm"></td>
                </tr>

            <?php $i++;
            }
        }
        ?>
        </form>
        </tbody>

    </table>
<script>
$("#submitAttendance").click(function(){
    if($("#session").val().length==0){
        alert("session is required");
    } else {
        $.cookie("sessionVal", $("#session").val());
        var data = $('form#attendanceForm').serialize();
        $.ajax({
            url: 'save-attendance.php',
            method: 'post',
            data: {formData: data},
            success: function (data) {
                console.log(data);
               if (data != null && data.success) {
                   alert('Success');
               } else {
                   alert(data.status);
               }
            },
            error: function () {
               alert('Error');
            }
        });
    }
});
</script>
<?php 
$conn->close();
include('footer.php');