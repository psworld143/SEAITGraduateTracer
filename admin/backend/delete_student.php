<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Check if `id` is passed and is a valid number
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $student_id = intval($_GET['id']);

    // Start transaction
    $conn->begin_transaction();

    try {
        // List of all tables that contain student survey data
        $tables = [
            'general_information',
            'educational_attainment',
            'professional_skills',
            'professional_examinations',
            'training_and_advanced_studies',
            'motivation_for_studies',
            'degree_reasons',
            'employment_status',
            'reasons_not_employed',
            'present_employment_status',
            'current_occupation',
            'job_positions',
            'company_information',
            'place_of_work',
            'employment_sector',
            'reasons_staying',
            'first_job_after_college',
            'first_job_related_to_course',
            'reasons_accepting',
            'reasons_changing',
            'first_job_duration',
            'job_finding_methods',
            'time_to_land_first_job',
            'initial_gross_monthly_earning',
            'curriculum_relevance',
            'useful_competencies',
            'curriculum_improvement',
            'values_learned',
            'community_services',
            'best_features'
        ];

        // Delete data from all survey-related tables
        foreach ($tables as $table) {
            $deleteQuery = "DELETE FROM $table WHERE student_id = ?";
            $stmt = $conn->prepare($deleteQuery);
            if ($stmt) {
                $stmt->bind_param('i', $student_id);
                $stmt->execute();
                $stmt->close();
            }
        }

        // Finally, delete the student record
        $deleteStudentQuery = "DELETE FROM students WHERE id = ?";
        $stmt = $conn->prepare($deleteStudentQuery);
        if ($stmt) {
            $stmt->bind_param('i', $student_id);
            $stmt->execute();
            $stmt->close();
        }

        // If everything went well, commit the transaction
        $conn->commit();
        echo json_encode(['success' => true, 'message' => 'Student and all associated survey data deleted successfully.']);

    } catch (Exception $e) {
        // If there was an error, rollback the transaction
        $conn->rollback();
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
} else {
    // Invalid or missing ID
    echo json_encode(['success' => false, 'message' => 'Error: Invalid or missing student ID.']);
}

$conn->close();
?>
