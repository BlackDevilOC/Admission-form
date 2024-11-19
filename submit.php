<?php
include('server_connection.php'); // Database connection
include('table_connection.php');  // Any additional table-related settings or connections

if(isset($_POST['submit'])){
    $full_name = $_POST['full_name'];
    $father_husband_name = $_POST['father_husband_name'];
    $dob = $_POST['dob'];
    $nic_smartcard_no = $_POST['nic_smartcard_no'];
    $gender = $_POST['gender'];
    $religion = $_POST['religion'];
    $nationality = $_POST['nationality'];
    $marital_status = $_POST['marital_status'];
    $domicile_district = $_POST['domicile_district'];
    $mobile_no = $_POST['mobile_no'];
    $permanent_address = $_POST['permanent_address'];
    $present_address = $_POST['present_address'];
    $course = $_POST['course_applied'];
    $academic_year = $_POST['academic_year'];
    $guardian_name = $_POST['guardian_name'];
    $degree = $_POST['degree'];
    $passing_year = $_POST['passing_year'];
    $board = $_POST['board'];
    $seat_no = $_POST['seat_no'];
    $total_marks = $_POST['total_marks'];
    $obtain_marks = $_POST['obtain_marks'];
    $grade = $_POST['grade'];
    $percentage = $_POST['percentage'];

    // SQL query to insert data into the students table
    $sql = "INSERT INTO students (
        full_name, father_husband_name, dob, nic_smartcard_no, gender, religion, nationality, 
        marital_status, domicile_district, mobile_no, permanent_address, present_address, 
        course_applied, academic_year, guardian_name, degree, passing_year, board, seat_no, 
        total_marks, obtain_marks, grade, percentage
    ) VALUES (
        '$full_name', '$father_husband_name', '$dob', '$nic_smartcard_no', '$gender', '$religion', 
        '$nationality', '$marital_status', '$domicile_district', '$mobile_no', '$permanent_address', 
        '$present_address', '$course', '$academic_year', '$guardian_name', '$degree', 
        '$passing_year', '$board', '$seat_no', '$total_marks', '$obtain_marks', '$grade', 
        '$percentage'
    )";

    if ($con->query($sql) === TRUE) {
        echo "New record created successfully";

        // Retrieve the last inserted ID
        $new_id = $con->insert_id;

        // Directory where the image will be saved
        $target_dir = "images/";

        // Ensure the images directory exists and is writable
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        // Check if the file was uploaded without errors
        if(isset($_FILES["picture"]) && $_FILES["picture"]["error"] == 0) {
            // Get the file extension
            $imageFileType = strtolower(pathinfo($_FILES["picture"]["name"], PATHINFO_EXTENSION));

            // New file name based on the new ID
            $new_file_name = $target_dir . $new_id . '.' . $imageFileType;

            // Check if image file is an actual image or fake image
            $check = getimagesize($_FILES["picture"]["tmp_name"]);
            if ($check !== false) {
                if (move_uploaded_file($_FILES["picture"]["tmp_name"], $new_file_name)) {
                    echo "The file has been uploaded and renamed to " . $new_file_name;
                } else {
                    echo "Sorry, there was an error uploading your file.";
                }
            } else {
                echo "File is not an image.";
            }
        } else {
            echo "File upload error. Code: " . $_FILES["picture"]["error"];
        }

        header("Location: dashboard.html");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $con->error;
    }
} else {
    echo "Direct user access is not allowed.";
    header("Location: index.html");
    exit();
}

$con->close();
?>
