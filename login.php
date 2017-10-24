<?php
$pageTitle="Login";
include('header.php');
require("db-connect.php");

$isLogin = 0;
$teacher = 0;
$student = 0;
$loginId = 0;
$errmsg = '';
if(isset($_POST['login']) && isset($_POST['email']) && !empty($_POST['email'])){

    $email = $_POST['email'];
    $query = "SELECT * FROM user WHERE email='".$email."' AND role='teacher';";

    $result = $conn->query($query);

    if ($result && $result->num_rows > 0){
        $isLogin = 1;
        // output data of each row
        while($row = $result->fetch_assoc()) {

            if($row['role']=='teacher'){
                $teacher=1;
                $student=0;
                header('Location: index.php');
            }
            else{
                $student=1;
                $teacher=0;
                header('Location: index.php');
            }
            setcookie('currentUser', $row['email']);
            setcookie('loginId', $row['id']);
        }
    }
    else {
        $errmsg = "User does no exist.";
    }
    $conn->close();
    setcookie('login', $isLogin);
    setcookie('teacher', $teacher);
    setcookie('student', $student);
}
?>
<form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>">
    <div class="form-group">
        <div class="row">
          <div class="col-md-6">
                <?php
                if (!empty($errmsg)) {
                echo '<div class="alert alert-danger" role="alert">';
                echo '<span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span> ';
                echo '<span class="sr-only">Error:</span>';
                    echo '<strong>' . $errmsg .'</strong>';
                    echo '</div>';
                }
                ?>
            <div class="input-group">
                <input type="email" name="email" id="email" class="form-control" required placeholder="Email address">
                <span class="input-group-btn"><input type="submit" name="login" class="btn btn-primary" value="Login"></span>
            </div><!-- /input-group -->
          </div><!-- /.col-md-6 -->
        </div><!-- /.row -->
    </div>
</form>
<?php
include('footer.php');