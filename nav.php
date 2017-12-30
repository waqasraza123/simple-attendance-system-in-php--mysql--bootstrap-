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
                <li <?php echo $pageTitle=="Take Attendance"||$pageTitle=="Attendance" ? 'class="active"' : ''; ?>><a href="<?php echo '//'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']); ?>">Home</a></li>
                <li <?php echo $pageTitle=="Register" ? 'class="active"' : ''; ?>><a href="register.php">Register</a></li>
                <li <?php echo $pageTitle=="Classes" ? 'class="active"' : ''; ?>><a href="classes.php">Classes</a></li>
                <li <?php echo $pageTitle=="Report" ? 'class="active"' : ''; ?>><a href="report.php">Report</a></li>
            </ul>
                <ul class="nav navbar-nav navbar-right" style="margin-right:25px;">
                <?php
                    if(isset($_COOKIE['student']) || isset($_COOKIE['teacher']) || isset($_COOKIE['login'])){
                        echo '<li><a href="logout.php" id="loginout" class="btn btn-default">Logout</a></li>';
                    } else {
                        echo '<li><a href="login.php" id="loginout" class="btn btn-default">Login</a></li>';
                    }
                ?>
            </ul>

        </div><!--/.navbar-collapse -->
    </div>
</nav>
