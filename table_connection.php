<?php
// Existing connection details
$host = "localhost";
$username = "root";
$password = "";
$db = "applicant";

// Create connection
$con = new mysqli($host, $username, $password, $db);

// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $con->connect_error);
}

// SQL query to create the table
$sql = "CREATE TABLE IF NOT EXISTS students (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(100),
    father_husband_name VARCHAR(100),
    dob DATE,
    nic_smartcard_no VARCHAR(20),
    gender VARCHAR(10),
    religion VARCHAR(50),
    nationality VARCHAR(50),
    marital_status VARCHAR(20),
    domicile_district VARCHAR(50),
    mobile_no VARCHAR(15),
    permanent_address TEXT,
    present_address TEXT,
    course_applied VARCHAR(100),
    academic_year VARCHAR(10),
    guardian_name VARCHAR(100),
    degree VARCHAR(100),
    passing_year VARCHAR(10),
    board VARCHAR(50),
    seat_no VARCHAR(20),
    total_marks INT,
    obtain_marks INT,
    grade VARCHAR(10),
    percentage FLOAT
)";

// Execute the query
if ($con->query($sql) === TRUE) {
    echo "<br>Table 'students' created successfully";
} else {
    echo "<br>Error creating table: " . $con->error;
}

?>
