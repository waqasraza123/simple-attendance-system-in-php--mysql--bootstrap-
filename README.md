# Simple Attendance System in PHP, MySQL and Bootstrap

Note: This is no longer maintained by the author. Feel free to fork this project and submit pull request if you fix issues listed in the TO DO section below.

Copyright (c) 2015 Chaudhry Waqas - MIT License

## Installation

Here are the steps you will need to complete in order to get it working.

**Step 1: Create a MySQL database.**

* Server:   localhost
* Database: attendance
* Username: root
* Password: [blank]

Edit the db-connect.php file to change these credentials.

**Step 2: Use the following SQL to create the tables.**

	CREATE TABLE `user` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `fullname` text NOT NULL,
	  `email` text NOT NULL,
	  `role` text NOT NULL,
	  `class` text NOT NULL,
	  PRIMARY KEY (id)
	);

	CREATE TABLE `class` (
	  `id` int NOT NULL AUTO_INCREMENT,
	  `name` text NOT NULL,
		PRIMARY KEY (id),
	   UNIQUE KEY (name(255))
	);

	CREATE TABLE `attendance` (
	  `studentid` int NOT NULL,
	  `classid` int NOT NULL,
	  `session` int NOT NULL,
	  `ispresent` int NOT NULL
	);

**Step 3: Setup the website.**

The first time you try to access the website, you will be prompted to create an Administrator account. This is the only time you will be able to do this from within Attendance System.

Next:

* Register teachers.
* Register students.

## Tips and Notes:

* The first time you access Attendance System, you will be prompted to create an Administrator without logging in. Should you delete this user, you will be prompted to create another one. This is the only time you can create a user without being logged-in as a teacher or administrator.
* There is no security here. Email addresses are not validated and there are no passwords. Login email addresses are just used to determine your role.
* The Register page enables you to create both teachers and students.
* Did you know? You can create students in more than one class.
* Login as an administrator to add attendance.
* Login as a student to view the attendance report. There is no filtering available.

This is obviously not a finished application but will give you a start if you want to develop your own Attendance web application.

## To Do:

- Fix saving on Take Attendance page (in save-attendance.php).
- Add account passwords support.
- Create a filter for the Attendance Report (code available in teacher.php).
- Create a way to delete a student from a class (from Take Attendance page?).
- When deleting a student, delete their attendance records too.
- When deleting a class, add deletion of attendance records too.
