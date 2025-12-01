<?php

require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/config_session.inc.php";
require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/input_validation.inc.php";;

// Set up error reporting for development
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Ensure the request method is POST, as expected from the form submission.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    // 1. Retrieve data from the POST request (using 'name' attributes from the HTML form)
    $exam_name      = $_POST["exam_title"];
    $student_mark   = $_POST["student_mark"];
    $exam_date      = $_POST["exam_date"];
    $highest_mark   = $_POST["highest_mark"];
    
    // 2. Retrieve required ID data (Source assumptions based on typical application flow)
    // NOTE: You must adjust these variables based on where you actually get this data.
    $student_id     = $_SESSION['student_id'] ?? null; // Assume a hidden field passes the student ID
    $subject        = $_SESSION['subject'] ?? null; // Assume a hidden field passes the subject
    $teacher_id     = $_SESSION["ref_id"] ?? null; // Assume the logged-in user (teacher) is submitting the data
    
    // 3. Basic Validation: Check if critical data is present
    if (empty($exam_name) || empty($exam_date) || empty($highest_mark) || empty($student_id) || empty($teacher_id) || empty($subject)) {
        // Handle missing data error gracefully
        header("Location: ../teacher_editor.php?error=missing_data&id=" . $student_id);
        die();
    }

    if (marks_invalid($highest_mark, $student_mark)){
        header("Location: ../teacher_editor.php?error=invalid_data&id=" . $student_id);
        die();
    }

    try {
        // 4. Require necessary files
        require_once $_SERVER['DOCUMENT_ROOT'] . "/includes/db.inc.php";
        require_once "student_report.model.inc.php"; // Contains the insert_exam function

        // 5. Execute the insertion function
        $result = insert_exam (
            $pdo,
            $student_id,
            $teacher_id,
            $subject,
            $exam_name,
            $exam_date,
            $highest_mark,
            $student_mark
        );

        // 6. Redirect on successful execution
        if ($result === true) {
             // Redirect to a confirmation page or the student's report page
            header("Location: ../teacher_editor.php?id=" . $student_id . "&success=exam_added");
        } else {
            // Handle insertion failure (e.g., database constraint violation)
            header("Location: ../teacher_editor.php?error=insert_failed&id=" . $student_id);
        }
       
        // Clean up connections
        $pdo = null;
        $stmt = null;
        die();
        
    } catch (PDOException $e) {
        // Handle database errors
        error_log("Query Failed: " . $e->getMessage());
//        header("Location: ../teacher_editor.php?error=db_error&id=" . $student_id);
        die();
    }
} else {
    // Redirect if the script is accessed directly without POST data
    header("Location: ../teacher_editor.php&id=" . $student_id);
    die();
}