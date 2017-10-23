<nav class="navbar navbar-inverse" style="border-radius: 0px;">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Attendance System</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li <?php echo $pageTitle=="Take Attendance"||$pageTitle=="Attendance" ? 'class="active"' : ''; ?>><a href="<?php echo 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>">Home</a></li>
                <li <?php echo $pageTitle=="Register" ? 'class="active"' : ''; ?>><a href="register.php">Register</a></li>
                <li <?php echo $pageTitle=="Classes" ? 'class="active"' : ''; ?>><a href="classes.php">Classes</a></li>
                <li <?php echo $pageTitle=="Login" ? 'class="active"' : ''; ?>><a href="login.php">Login</a></li>
                <li <?php echo $pageTitle=="Logout" ? 'class="active"' : ''; ?>><a href="logout.php">Logout</a></li>
            </ul>

        </div --><!--/.navbar-collapse -->
    </div>
</nav>
