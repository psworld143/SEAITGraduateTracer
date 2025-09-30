<?php
include('../db_conn.php'); // Database connection
// Get student ID from POST request
$student_id = isset($_POST['student_id']) ? (int)$_POST['student_id'] : 0;

if ($student_id <= 0) {
    die(json_encode([
        'success' => false,
        'message' => "Invalid student ID"
    ]));
}

// Add debugging information
error_log("Fetching survey data for student ID: " . $student_id);

try {
    // Fetch general information
    $general_query = "SELECT * FROM general_information WHERE student_id = ?";
    $stmt = $conn->prepare($general_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $general_result = $stmt->get_result();
    $general_info = $general_result->fetch_assoc();
    
    // Debug general info
    error_log("General Info: " . print_r($general_info, true));

    // Fetch educational attainment
    $education_query = "SELECT * FROM educational_attainment WHERE student_id = ?";
    $stmt = $conn->prepare($education_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $education_result = $stmt->get_result();
    $educational_info = [];
    while ($row = $education_result->fetch_assoc()) {
        $educational_info[] = $row;
    }

    // Fetch professional skills
    $skills_query = "SELECT * FROM professional_skills WHERE student_id = ?";
    $stmt = $conn->prepare($skills_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $skills_result = $stmt->get_result();
    $skills = [];
    while ($row = $skills_result->fetch_assoc()) {
        $skills[] = $row;
    }

    // Fetch professional examinations
    $exams_query = "SELECT * FROM professional_examinations WHERE student_id = ?";
    $stmt = $conn->prepare($exams_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $exams_result = $stmt->get_result();
    $examinations = [];
    while ($row = $exams_result->fetch_assoc()) {
        $examinations[] = $row;
    }

    // Fetch training and advanced studies
    $training_query = "SELECT * FROM training_and_advanced_studies WHERE student_id = ?";
    $stmt = $conn->prepare($training_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $training_result = $stmt->get_result();
    $training = [];
    while ($row = $training_result->fetch_assoc()) {
        $training[] = $row;
    }

    // Fetch motivation
    $motivation_query = "SELECT * FROM motivation_for_studies WHERE student_id = ?";
    $stmt = $conn->prepare($motivation_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $motivation_result = $stmt->get_result();
    $motivation = [];
    while ($row = $motivation_result->fetch_assoc()) {
        $motivation[] = $row;
    }

    // Fetch degree reasons
    $reasons_query = "SELECT * FROM degree_reasons WHERE student_id = ?";
    $stmt = $conn->prepare($reasons_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $reasons_result = $stmt->get_result();
    $reasons = [];
    while ($row = $reasons_result->fetch_assoc()) {
        $reasons[] = $row;
    }

    // Fetch employment status
    $employment_query = "SELECT * FROM employment_status WHERE student_id = ?";
    $stmt = $conn->prepare($employment_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $employment_result = $stmt->get_result();
    $employment_status = [];
    while ($row = $employment_result->fetch_assoc()) {
        $employment_status[] = $row;
    }

    // Fetch reasons not employed if applicable
    $reasons_not_employed = [];
    if ($employment_status && $employment_status[0]['status'] === 'no') {
        $reasons_query = "SELECT * FROM reasons_not_employed WHERE student_id = ?";
        $stmt = $conn->prepare($reasons_query);
        $stmt->bind_param("i", $student_id);
        $stmt->execute();
        $reasons_result = $stmt->get_result();
        while ($row = $reasons_result->fetch_assoc()) {
            $reasons_not_employed[] = $row;
        }
    }

    // Fetch present employment status
    $present_query = "SELECT * FROM present_employment_status WHERE student_id = ?";
    $stmt = $conn->prepare($present_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $present_result = $stmt->get_result();
    $present_employment = [];
    while ($row = $present_result->fetch_assoc()) {
        $present_employment[] = $row;
    }

    // Fetch current occupation
    $occupation_query = "SELECT * FROM current_occupation WHERE student_id = ?";
    $stmt = $conn->prepare($occupation_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $occupation_result = $stmt->get_result();
    $current_occupation = [];
    while ($row = $occupation_result->fetch_assoc()) {
        $current_occupation[] = $row;
    }

    // Fetch job positions
    $job_positions_query = "SELECT * FROM job_positions WHERE student_id = ?";
    $stmt = $conn->prepare($job_positions_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $job_positions_result = $stmt->get_result();
    $job_positions = [];
    while ($row = $job_positions_result->fetch_assoc()) {
        $job_positions[] = $row;
    }

    // Fetch company information
    $company_query = "SELECT * FROM company_information WHERE student_id = ?";
    $stmt = $conn->prepare($company_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $company_result = $stmt->get_result();
    $company_info = [];
    while ($row = $company_result->fetch_assoc()) {
        $company_info[] = $row;
    }

    // Fetch place of work
    $place_query = "SELECT * FROM place_of_work WHERE student_id = ?";
    $stmt = $conn->prepare($place_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $place_result = $stmt->get_result();
    $place_of_work = [];
    while ($row = $place_result->fetch_assoc()) {
        $place_of_work[] = $row;
    }

    // Fetch employment sector
    $sector_query = "SELECT * FROM employment_sector WHERE student_id = ?";
    $stmt = $conn->prepare($sector_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $sector_result = $stmt->get_result();
    $employment_sector = [];
    while ($row = $sector_result->fetch_assoc()) {
        $employment_sector[] = $row;
    }

    // Fetch reasons for staying
    $staying_query = "SELECT * FROM reasons_staying WHERE student_id = ?";
    $stmt = $conn->prepare($staying_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $staying_result = $stmt->get_result();
    $reasons_staying = [];
    while ($row = $staying_result->fetch_assoc()) {
        $reasons_staying[] = $row;
    }

    // Fetch first job information
    $first_job_query = "SELECT * FROM first_job_after_college WHERE student_id = ?";
    $stmt = $conn->prepare($first_job_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $first_job_result = $stmt->get_result();
    $first_job = [];
    while ($row = $first_job_result->fetch_assoc()) {
        $first_job[] = $row;
    }

    // Fetch first job related to course
    $related_query = "SELECT * FROM first_job_related_to_course WHERE student_id = ?";
    $stmt = $conn->prepare($related_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $related_result = $stmt->get_result();
    $first_job_related = [];
    while ($row = $related_result->fetch_assoc()) {
        $first_job_related[] = $row;
    }

    // Fetch reasons for accepting job
    $accepting_query = "SELECT * FROM reasons_accepting WHERE student_id = ?";
    $stmt = $conn->prepare($accepting_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $accepting_result = $stmt->get_result();
    $reasons_accepting = [];
    while ($row = $accepting_result->fetch_assoc()) {
        $reasons_accepting[] = $row;
    }

    // Fetch reasons for changing
    $changing_query = "SELECT * FROM reasons_changing WHERE student_id = ?";
    $stmt = $conn->prepare($changing_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $changing_result = $stmt->get_result();
    $reasons_changing = [];
    while ($row = $changing_result->fetch_assoc()) {
        $reasons_changing[] = $row;
    }

    // Fetch first job duration
    $duration_query = "SELECT * FROM first_job_duration WHERE student_id = ?";
    $stmt = $conn->prepare($duration_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $duration_result = $stmt->get_result();
    $first_job_duration = [];
    while ($row = $duration_result->fetch_assoc()) {
        $first_job_duration[] = $row;
    }

    // Fetch job finding methods
    $finding_query = "SELECT * FROM job_finding_methods WHERE student_id = ?";
    $stmt = $conn->prepare($finding_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $finding_result = $stmt->get_result();
    $job_finding = [];
    while ($row = $finding_result->fetch_assoc()) {
        $job_finding[] = $row;
    }

    // Fetch time to land first job
    $time_query = "SELECT * FROM time_to_land_first_job WHERE student_id = ?";
    $stmt = $conn->prepare($time_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $time_result = $stmt->get_result();
    $time_to_land = [];
    while ($row = $time_result->fetch_assoc()) {
        $time_to_land[] = $row;
    }

    // Fetch initial earnings
    $earning_query = "SELECT * FROM initial_gross_monthly_earning WHERE student_id = ?";
    $stmt = $conn->prepare($earning_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $earning_result = $stmt->get_result();
    $initial_earning = [];
    while ($row = $earning_result->fetch_assoc()) {
        $initial_earning[] = $row;
    }

    // Fetch curriculum relevance
    $curriculum_query = "SELECT * FROM curriculum_relevance WHERE student_id = ?";
    $stmt = $conn->prepare($curriculum_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $curriculum_result = $stmt->get_result();
    $curriculum_relevance = [];
    while ($row = $curriculum_result->fetch_assoc()) {
        $curriculum_relevance[] = $row;
    }

    // Fetch useful competencies
    $competencies_query = "SELECT * FROM useful_competencies WHERE student_id = ?";
    $stmt = $conn->prepare($competencies_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $competencies_result = $stmt->get_result();
    $useful_competencies = [];
    while ($row = $competencies_result->fetch_assoc()) {
        $useful_competencies[] = $row;
    }

    // Fetch curriculum improvement suggestions
    $improvement_query = "SELECT * FROM curriculum_improvement WHERE student_id = ?";
    $stmt = $conn->prepare($improvement_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $improvement_result = $stmt->get_result();
    $curriculum_improvement = [];
    while ($row = $improvement_result->fetch_assoc()) {
        $curriculum_improvement[] = $row;
    }

    // Fetch values learned
    $values_query = "SELECT * FROM values_learned WHERE student_id = ?";
    $stmt = $conn->prepare($values_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $values_result = $stmt->get_result();
    $values_learned = [];
    while ($row = $values_result->fetch_assoc()) {
        $values_learned[] = $row;
    }

    // Fetch community services
    $services_query = "SELECT * FROM community_services WHERE student_id = ?";
    $stmt = $conn->prepare($services_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $services_result = $stmt->get_result();
    $community_services = [];
    while ($row = $services_result->fetch_assoc()) {
        $community_services[] = $row;
    }

    // Fetch best features
    $features_query = "SELECT * FROM best_features WHERE student_id = ?";
    $stmt = $conn->prepare($features_query);
    $stmt->bind_param("i", $student_id);
    $stmt->execute();
    $features_result = $stmt->get_result();
    $best_features = [];
    while ($row = $features_result->fetch_assoc()) {
        $best_features[] = $row;
    }

    // Before sending response, log the final data structure
    $response_data = [
        'success' => true,
        'data' => [
            'general_info' => $general_info,
            'educational_info' => $educational_info,
            'skills' => $skills,
            'examinations' => $examinations,
            'training' => $training,
            'motivation' => $motivation,
            'employment_status' => $employment_status,
            'reasons_not_employed' => $reasons_not_employed,
            'present_employment' => $present_employment,
            'current_occupation' => $current_occupation,
            'company_info' => $company_info,
            'place_of_work' => $place_of_work,
            'employment_sector' => $employment_sector,
            'reasons_staying' => $reasons_staying,
            'first_job' => $first_job,
            'first_job_related' => $first_job_related,
            'reasons_accepting' => $reasons_accepting,
            'reasons_changing' => $reasons_changing,
            'first_job_duration' => $first_job_duration,
            'job_finding' => $job_finding,
            'time_to_land' => $time_to_land,
            'initial_earning' => $initial_earning,
            'curriculum_relevance' => $curriculum_relevance,
            'useful_competencies' => $useful_competencies,
            'curriculum_improvement' => $curriculum_improvement,
            'values_learned' => $values_learned,
            'community_services' => $community_services,
            'best_features' => $best_features
        ]
    ];
    
    error_log("Final Response Data: " . print_r($response_data, true));
    echo json_encode($response_data);

} catch (Exception $e) {
    error_log("Error in fetch_survey.php: " . $e->getMessage());
    echo json_encode([
        'success' => false,
        'message' => $e->getMessage()
    ]);
}

// Close connection
$conn->close();
?>