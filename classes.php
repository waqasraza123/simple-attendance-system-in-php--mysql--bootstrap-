<?php
$pageTitle = "Classes";
include('header.php');
require("db-connect.php");
?>
<form method="post" action="<?php echo($_SERVER['PHP_SELF'])?>" style="margin-bottom: 25px;">
    <div class="form-group">
        <label for="name"> Add Class Name </label>
        <input type="text" id="name" name="name" class="form-control" placeholder="ENG101" required>
    </div>
    <input type="submit" name="classes" class="btn btn-danger" value="Save class">
</form>
<?php
$query = "SELECT * FROM class;";
$classes = $classes = mysqli_query($conn, $query);
if($classes && mysqli_num_rows($classes)){ ?>
    <div class="panel panel-success">
       <div class = "panel-heading">
           <h2 class = "panel-title">Existing classes</h2>
       </div>
       <div class = "panel-body">
           <ul>
           <?php
             // Get list of available classes.
             while($class = $classes->fetch_assoc()){
                echo '<li><a href="?delete=' . $class['id'] . '" class="btn btn-danger btn-sm" style="margin:2px;" title="Delete class">X</a> ' . $class['name'] . '</li>';
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
if(isset($_POST['classes']) && !empty($_POST['name'])){
    $name = $_POST['name'];
    // Prepare query to be saved to db.
    $query = "INSERT INTO class(`name`) VALUES('".$name."')";
    if(mysqli_query($conn, $query)){
        header('Location: ' . $_SERVER['PHP_SELF']);
    }
    else{
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }
}
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