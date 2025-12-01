<?php

declare(strict_types=1);

function insert_exam (
        $pdo ,
        $student_id ,
        $teacher_id ,
        $subject,
        $exam_name ,
        $exam_date ,
        $highest_mark ,
        $student_mark
 ) {
    $query = "INSERT INTO exams 
        (student_id, teacher_id, subject, exam_title, full_mark, student_mark, exam_date) 
        VALUES 
        (:student_id, :teacher_id, :subject, :exam_name, :highest_mark, :student_mark, :exam_date);" ;

    // The school_id is NOT used in your SQL query, and is not passed as a parameter.
    // $school_id = $_SESSION[ 'school_id' ] ; // Removed as it's not bound or used.

    $stmt = $pdo -> prepare ( $query ) ;

    // --- Completed bindParam calls using the new function parameters ---
    $stmt -> bindParam ( ":student_id" , $student_id ) ;
    $stmt -> bindParam ( ":teacher_id" , $teacher_id ) ;
    $stmt -> bindParam ( ":subject" , $subject ) ;
    // The original code was missing these three bindings:
    $stmt -> bindParam ( ":exam_name" , $exam_name ) ;
    $stmt -> bindParam ( ":highest_mark" , $highest_mark ) ;
    $stmt -> bindParam ( ":student_mark" , $student_mark ) ;
    $stmt -> bindParam ( ":exam_date" , $exam_date ) ;
    // The three redundant and incorrect :school_id bindings have been removed.
    // ----------------------------------------------------------------------

    $success = $stmt -> execute () ;

    // For an INSERT query, you don't use fetch(). You usually return the success status or the number of affected rows.
    // $resulte = $stmt -> fetch ( PDO :: FETCH_ASSOC ) ; // This line is incorrect for an INSERT and is commented out.

    $pdo = null ;
    $stmt = null ;

    // Return the execution status (TRUE on success, FALSE on failure)
    return $success ;
}


function list_exams($pdo, $student_id, $subject) {
    // 2. Define the SELECT query
    $query = "
        SELECT 
            exam_title, 
            exam_date, 
            full_mark, 
            student_mark 
        FROM exams 
        WHERE student_id = :student_id 
        AND subject = :subject
        ORDER BY exam_date DESC;";

    try {
        // 3. Prepare the statement
        $stmt = $pdo->prepare($query);

        // 4. Bind the parameters
        $stmt->bindParam(':student_id', $student_id, PDO::PARAM_INT);
        $stmt->bindParam(':subject', $subject, PDO::PARAM_STR);
        
        // 5. Execute the query
        $stmt->execute();

        // 6. Fetch all results
        return $stmt->fetchAll(PDO::FETCH_ASSOC);

    } catch (PDOException $e) {
        // Log error and/or return an empty array on failure
        error_log("Database Error listing exams: " . $e->getMessage());
        return [];
    }
}