<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="UTF-8">
    <title>Attendance System</title>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!-- jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>

    <!-- Latest compiled JavaScript -->
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>
<?php include ("nav.php");?>
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="center-form">
                <div class="panel panel-primary" style="border: none;">
                    <div class="panel-heading"><h1>Register</h1></div>
                    <form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>" style="margin-top: 50px;">

                        <div class="form-group">
                            <label for="email"> Name </label>
                            <input type="text" name="name" class="form-control" placeholder="chaudhry waqas" required>
                        </div>

                        <div class="form-group">
                            <label for="email"> Email </label>
                            <input type="email" name="email" class="form-control" placeholder="username@gmail.com" required>
                        </div>

                        <div class="form-group">
                            <label for="class">Class:</label>
                            <select class="form-control" name="class">
                                <option value="BESE4A">BESE4A</option>
                                <option value="BESE4C">BESE4C</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select class="form-control" name="role">
                                <option value="student">Student</option>
                                <option rel="teacher">Teacher</option>
                            </select>
                        </div>

                        <input type="submit" name="register" class="btn btn-danger" value="Register">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>

<?php require("db-connect.php");

if(isset($_POST['register']) && !empty($_POST['email'])){
    $email = $_POST['email'];
    $name = $_POST['name'];
    $class = $_POST['class'];
    $role = $_POST['role'];

    echo  "here";
    //prepare query to be saved to db
    //start the single quotes, end the double quotes
    //after concatenation start double quotes again closed before concat and close the single
    //quotes too, then close the outer most double quotes
    $query = "INSERT INTO user(`fullname`, `email`, `class`, `role`) VALUES('".$name."', '".$email."', '".$class."', '".$role."')";
    if(mysqli_query($conn, $query)){
        //redirect user to login page
        //echo "done";
        header('Location: login.php');

    }
    else{
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}