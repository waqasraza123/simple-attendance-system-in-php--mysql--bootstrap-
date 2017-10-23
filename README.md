# Simple Attendance System in PHP, MySQL and Bootstrap
Note: This is no longer maintained by the author.

Here are the steps go get it working.

**Step 1: Create a MySQL database called "attendance".**

**Step 2: Use the following SQL to create the tables.**

    CREATE TABLE `attendance` (
      `studentid` int NOT NULL,
      `classid` int NOT NULL,
      `session` int NOT NULL,
      `ispresent` int NOT NULL
    );

    CREATE TABLE `class` (
      `id` int NOT NULL,
      `name` text NOT NULL,
       PRIMARY KEY (id)
    );

    CREATE TABLE `user` (
      `id` int NOT NULL AUTO_INCREMENT,
      `fullname` text NOT NULL,
      `email` text NOT NULL,
      `role` text NOT NULL,
      `class` text NOT NULL,
      PRIMARY KEY (id)
    );

**Step 3: Go to the website. Start by clicking on the "Register" link.**
* Register yourself as a teacher. Don't worry, anyone can create a teacher. Try it.
* Register students.

Tips and Notes:

* There is no security here. Email addresses are not validated and there are no passwords.
* Class names are hard coded in the register.php file. There is therefore no option to add classes.
* The Register page enables you to create both teachers and students.
* Login as an administrator to add attendance.
* Login as a student to view the attendance report. There is no filtering available.

This is obviously not a finished application but will give you a start if you want to develop your own Attendance web application.
