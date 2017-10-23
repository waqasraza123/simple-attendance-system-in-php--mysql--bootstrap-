<?php
$pageTitle = 'Register';
include('header.php');
require("db-connect.php");
?>
<form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
    <div class="form-group">
        <label for="email"> Name </label>
        <input type="text" name="name" class="form-control" placeholder="Firstname Lastname" required>
    </div>

    <div class="form-group">
        <label for="email"> Email </label>
        <input type="email" name="email" class="form-control" placeholder="username@gmail.com" required>
    </div>

    <div class="form-group">
        <label for="class">Class:</label>
        <select class="form-control" name="class">
        <?php
            // Get list of available classes.
            $query = "SELECT * FROM class";
            $classes = mysqli_query($conn, $query);
            if($classes){ 
                while($class = $classes->fetch_assoc()){
                    echo '<option value="' . $class['name'] . '">' . $class['name'] . '</option>';
                }
            } else{
                echo '<option value="-1" disabled>No classes defined</option>';
            }
        ?>
        </select>
    </div>

    <div class="form-group">
        <label for="role">Role:</label>
        <select class="form-control" name="role">
            <option value="student">Student</option>
            <option value="teacher">Teacher</option>
        </select>
    </div>

    <input type="submit" name="register" class="btn btn-danger" value="Register">
</form>
<?php
if(isset($_POST['register']) && !empty($_POST['email'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $role = $_POST['role'];

    // Prepare query to be saved to db.
    // start the single quotes, end the double quotes
    // after concatenation start double quotes again closed before concat and close the single
    // quotes too, then close the outer most double quotes
    $query = "INSERT INTO user(`fullname`, `email`, `class`, `role`) VALUES('".$name."', '".$email."', '".$class."', '".$role."')";
    if(mysqli_query($conn, $query)){
        if ($role == 'teacher') {
            //redirect user to login page
            header('Location: login.php');
        } else { // $role == student
            //redirect user to login page
            header('Location: ' . $_SERVER['PHP_SELF']);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
$conn->close();
include('footer.php');