<?php
$pageTitle = "Classes";
include('header.php');
require("db-connect.php");
if(!isset($_COOKIE['teacher'])){
    $query = "SELECT NULL FROM user WHERE class='administrator' LIMIT 1";
    $result = mysqli_query($conn, $query);
    $firstAccess = (mysqli_num_rows($result) == 0);
    if (!$firstAccess) {
        echo 'Only teachers can create new classes.';
        $conn->close();
        include('footer.php');
        exit;
    }
} else {
    $firstAccess = false;
}
?>
<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>" style="margin-bottom: 25px;">
    <div class="form-group">
        <label for="name"> Add Class Name </label>
        <input type="text" id="name" name="name" class="form-control" placeholder="ENG101" required>
    </div>
    <input type="submit" name="classes" class="btn btn-primary" value="Save class">
</form>
<?php
if(isset($_POST['classes']) && !empty($_POST['name'])){
    $name = $_POST['name'];
    // Ensure it doesn't already exist.
    $query = "SELECT 1 FROM class WHERE UPPER(`name`) = UPPER('$name') LIMIT 1";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)  == 1) {
        echo '<div class="alert alert-danger" role="alert">
          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
          <span class="sr-only">Error:</span>
          Class "' . $name . '" already exists.
        </div>';
    } else {
        // Save class to database.
        if (strtolower($name) == 'administrator' && !$firstAccess) {
            echo '<div class="alert alert-danger" role="alert">
              <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
              <span class="sr-only">Error:</span>
              You cannot create a class called "' . $name . '".
            </div>';
        } else {
            $query = "INSERT IGNORE INTO class(`name`) VALUES('".$name."')";
            if(mysqli_query($conn, $query)){
                header('Location: ' . $_SERVER['PHP_SELF']);
            }
            else{
                echo "Error: " . $query . "<br>" . mysqli_error($conn);
            }
        }
    }
}

// Generate list of classes.
$query = "SELECT * FROM class ORDER BY name;";
$classes = $classes = mysqli_query($conn, $query);
if($classes && mysqli_num_rows($classes)){ ?>
    <div class="panel panel-success">
       <div class = "panel-heading">
           <h2 class = "panel-title">Current classes</h2>
       </div>
       <div class = "panel-body">
           <ul style="list-style: none;">
           <?php
             // Get list of available classes.
             while($class = $classes->fetch_assoc()){
                echo '<li><a href="?delete=' . $class['id'] . '" class="btn btn-danger btn-sm" style="margin:2px;"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span><span class="sr-only">Delete class</span></a> ' . $class['name'] . '</li>';
             }
           ?>
           </ul>
       </div>
   </div>
<?php
} else {
?>
    <div class = "panel panel-warning">
       <div class = "panel-heading">
          <h2 class = "panel-title">Warning</h2>
       </div>
       <div class = "panel-body">
          No classes defined.
       </div>
    </div>
<?php
}

// Delete class name from class table.
if(isset($_GET['delete'])){
    $id = $_GET['delete'];
    // Prepare query to be saved to db.
    $query = "DELETE FROM class WHERE `id`='".$id."';";
    if(mysqli_query($conn, $query)){
        $query = "DELETE FROM attendance WHERE `classid`='".$id."';";
        mysqli_query($conn, $query);
        header('Location: ' . $_SERVER['PHP_SELF']);
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}

$conn->close();
include('footer.php');