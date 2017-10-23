<?php
$pageTitle = 'Take Attendance';
include('header.php');

if(!(isset($_COOKIE['teacher']) && $_COOKIE['teacher']==1)){
    die("<b>you can not access this page</b>");
}
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

if(isset($_GET['class']) && !empty($_GET['class'])){
    $whichClass = $_GET['class'];
    $whichClassSQL = "AND class='" . $_GET['class'] . "'";
} else {
    $whichClass = '';
    $whichClassSQL = 'ORDER BY class';
}
    
$query = "SELECT * FROM user WHERE role='student' $whichClassSQL;";
$result = $conn->query($query);
?>
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
        if(mysqli_num_rows($result) > 0){
            $i=0;
            while($row = $result->fetch_assoc()){

                ?>
                <tr>
                    <input type="hidden" value="<?php echo($row['id']);?>">
                    <td><input type="text" readonly="readonly" name="name[]" value="<?php echo $row['fullname'];?>"></td>
                    <td><input type="text" readonly="readonly" name="email[]" value="<?php echo $row['email'];?>"</td>
                    <td><input type="text" readonly="readonly" name="class[]" value="<?php echo $row['class'];?>"</td>
                    <td><input type="radio" value="present" name="present[<?php echo $i; ?>]" checked></td>
                    <td><input type="radio" value="absent" name="present[<?php echo $i; ?>]"></td>
                </tr>


            <?php $i++;
            }
        }
        ?>
            <input type="number" id="session" name="sessionVal" placeholder="Session Value i.e 1" required><br>
            <input id="submitAttendance" type="button" class="btn btn-success" value="Submit Attendance" name="submitAttendance">
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
<?php include('footer.php'); ?>