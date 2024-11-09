<?php
include('../db_conn.php');
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $conn->begin_transaction();

    try {
        // Insert into general_information table
        $name = $_POST['name'] ?? '';
        $email_address = $_POST['email_address'] ?? '';
        $telephone_contact = $_POST['telephone_contact'] ?? '';
        $mobile_phone_number = $_POST['mobile_phone_number'] ?? null;
        $civil_status = $_POST['civil_status'] ?? '';
        $date = $_POST['date'] ?? '';
        $region_of_origin = $_POST['region_of_origin'] ?? '';
        $province_of_origin = $_POST['province_of_origin'] ?? '';
        $location_of_residence = $_POST['location_of_residence'] ?? '';
        $municipalities = $_POST['municipalities'] ?? '';

        $stmt = $conn->prepare("INSERT INTO general_information 
            (name, email_address, telephone_contact, mobile_phone_number, civil_status, date, region_of_origin, province_of_origin, location_of_residence, municipalities) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssssssss", $name, $email_address, $telephone_contact, $mobile_phone_number, $civil_status, $date, $region_of_origin, $province_of_origin, $location_of_residence, $municipalities);
        $stmt->execute();
        $general_info_id = $stmt->insert_id;

        // Insert into educational_attainment table
        if (!empty($_POST['degree']) && is_array($_POST['degree'])) {
            $degrees = $_POST['degree'];
            $colleges = $_POST['college_university'];
            $years = $_POST['year_graduated'];
            $honors = $_POST['honors_awards'];

            foreach ($degrees as $index => $degree) {
                $college = $colleges[$index] ?? '';
                $year = $years[$index] ?? '';
                $honor = $honors[$index] ?? '';
                $stmt = $conn->prepare("INSERT INTO educational_attainment (degree, college_university, year_graduated, honors_awards) VALUES (?, ?, ?, ?)");
                $stmt->bind_param("ssss", $degree, $college, $year, $honor);
                if (!$stmt->execute()) throw new Exception("Failed to insert into educational_attainment.");
            }
        }

// Insert into professional_skills table
$skills_input = $_POST['skill'] ?? null;
if ($skills_input !== null) {
    // Split the skills by commas and trim whitespace
    $skills = array_map('trim', explode(',', $skills_input));
    
    foreach ($skills as $skill) {
        if (!empty($skill)) { // Ensure no empty values are inserted
            $stmt = $conn->prepare("INSERT INTO professional_skills (skill) VALUES (?)");
            $stmt->bind_param("s", $skill);
            if (!$stmt->execute()) throw new Exception("Failed to insert into professional_skills.");
        }}}
    

        // Insert into professional_examinations table
        if (!empty($_POST['exam_name']) && is_array($_POST['exam_name'])) {
            $exams = $_POST['exam_name'];
            $dates_taken = $_POST['date_taken'];
            $ratings = $_POST['rating'];

            foreach ($exams as $index => $exam) {
                $date_taken = $dates_taken[$index] ?? '';
                $rating = $ratings[$index] ?? '';
                $stmt = $conn->prepare("INSERT INTO professional_examinations (exam_name, date_taken, rating) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $exam, $date_taken, $rating);
                if (!$stmt->execute()) throw new Exception("Failed to insert into professional_examinations.");
            }
        }

        // Insert into degree_reasons table
        $undergrad_high_grades = isset($_POST['undergrad_high_grades']) ? 1 : 0;
        $grad_high_grades = isset($_POST['grad_high_grades']) ? 1 : 0;
        $other_reason = $_POST['other_reason'] ?? null;

        $stmt = $conn->prepare("INSERT INTO degree_reasons (undergrad_high_grades, grad_high_grades, other_reason) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $undergrad_high_grades, $grad_high_grades, $other_reason);
        if (!$stmt->execute()) throw new Exception("Failed to insert into degree_reasons.");

                // Insert into training_and_advanced_studies table
                if (!empty($_POST['training_title']) && is_array($_POST['training_title'])) {
                    $training_titles = $_POST['training_title'];
                    $durations = $_POST['duration_credits'];
                    $institutions = $_POST['institution'];
        
                    foreach ($training_titles as $index => $title) {
                        $duration = $durations[$index] ?? '';
                        $institution = $institutions[$index] ?? '';
                        $stmt = $conn->prepare("INSERT INTO training_and_advanced_studies (training_title, duration_and_credits, institution) VALUES (?, ?, ?)");
                        $stmt->bind_param("sss", $title, $duration, $institution);
                        if (!$stmt->execute()) throw new Exception("Failed to insert into training_and_advanced_studies.");
                    }
                }
        
                // Insert into motivation_for_studies table
                $motivation = $_POST['motivation'] ?? 'other';
                $other_motivation = ($_POST['motivation'] === 'other') ? $_POST['other_motivation'] : null;
        
                $stmt = $conn->prepare("INSERT INTO motivation_for_studies (motivation, other_motivation) VALUES (?, ?)");
                $stmt->bind_param("ss", $motivation, $other_motivation);
                if (!$stmt->execute()) throw new Exception("Failed to insert into motivation_for_studies.");
        
        // Insert into employment_status table
        // Insert into employment_status table
        $employment_status = $_POST['employment_status'] ?? null;
        if ($employment_status) {
            $stmt = $conn->prepare("INSERT INTO employment_status (status) VALUES (?)");
            $stmt->bind_param("s", $employment_status);
            if (!$stmt->execute()) throw new Exception("Failed to insert into employment_status.");
        }

        // Insert into reasons_not_employed table if applicable
        if ($employment_status == 'no' || $employment_status == 'never') {
            if (!empty($_POST['reason_not_employed'])) {
                $reasons_not_employed = $_POST['reason_not_employed'];
                $other_reason = $_POST['other_reason'] ?? null;

                foreach ($reasons_not_employed as $reason) {
                    $stmt = $conn->prepare("INSERT INTO reasons_not_employed (reason_not_employed, other_reason) VALUES (?, ?)");
                    $stmt->bind_param("ss", $reason, $other_reason);
                    if (!$stmt->execute()) throw new Exception("Failed to insert into reasons_not_employed.");
                }
            }
        }

        // Insert into present_employment_status table
        $employment_status_current = $_POST['employment_status_current'] ?? 'unemployed';
        $stmt = $conn->prepare("INSERT INTO present_employment_status (employment_status_current) VALUES (?)");
        $stmt->bind_param("s", $employment_status_current);
        if (!$stmt->execute()) throw new Exception("Failed to insert into present_employment_status.");

        // Insert into current_occupation table
        $current_occupation = $_POST['current_occupation'] ?? null;
        if ($current_occupation !== null) {
            $stmt = $conn->prepare("INSERT INTO current_occupation (current_occupation) VALUES (?)");
            $stmt->bind_param("s", $current_occupation);
            if (!$stmt->execute()) throw new Exception("Failed to insert into current_occupation.");
        }

        // Insert into company_information table
        $company_name = $_POST['company_name'] ?? null;
        if ($company_name !== null) {
            $stmt = $conn->prepare("INSERT INTO company_information (company_name) VALUES (?)");
            $stmt->bind_param("s", $company_name);
            if (!$stmt->execute()) throw new Exception("Failed to insert into company_information.");
        }

        // Insert into place_of_work table
        $local_place = $_POST['local_place'] ?? null;
        $abroad_place = $_POST['abroad_place'] ?? null;

        $stmt = $conn->prepare("INSERT INTO place_of_work (local_place, abroad_place) VALUES (?, ?)");
        $stmt->bind_param("ss", $local_place, $abroad_place);
        if (!$stmt->execute()) throw new Exception("Failed to insert into place_of_work.");

        // Commit transaction
        $conn->commit();
        echo json_encode(['success' => 'Data has been successfully saved.']);

                // Insert into employment_status table
        $employment_status = $_POST['employment_status'] ?? null;
        if ($employment_status) {
            $stmt = $conn->prepare("INSERT INTO employment_status (status) VALUES (?)");
            $stmt->bind_param("s", $employment_status);
            if (!$stmt->execute()) throw new Exception("Failed to insert into employment_status.");
        }

        // Insert into reasons_not_employed table (if applicable)
        if (isset($_POST['reason_not_employed']) && is_array($_POST['reason_not_employed'])) {
            $reasons_not_employed = $_POST['reason_not_employed'];
            $other_reason = $_POST['other_reason'] ?? null;
            foreach ($reasons_not_employed as $reason) {
                $stmt = $conn->prepare("INSERT INTO reasons_not_employed (reason_not_employed, other_reason) VALUES (?, ?)");
                $stmt->bind_param("ss", $reason, $other_reason);
                if (!$stmt->execute()) throw new Exception("Failed to insert into reasons_not_employed.");
            }
        }

        // Insert into present_employment_status table
        $employment_status_current = $_POST['employment_status_current'] ?? null;
        if ($employment_status_current) {
            $stmt = $conn->prepare("INSERT INTO present_employment_status (employment_status_current) VALUES (?)");
            $stmt->bind_param("s", $employment_status_current);
            if (!$stmt->execute()) throw new Exception("Failed to insert into present_employment_status.");
        }

        // Insert into current_occupation table
        $current_occupation = $_POST['current_occupation'] ?? null;
        if ($current_occupation) {
            $stmt = $conn->prepare("INSERT INTO current_occupation (current_occupation) VALUES (?)");
            $stmt->bind_param("s", $current_occupation);
            if (!$stmt->execute()) throw new Exception("Failed to insert into current_occupation.");
        }

        // Insert into company_information table
        $company_name = $_POST['company_name'] ?? null;
        if ($company_name) {
            $stmt = $conn->prepare("INSERT INTO company_information (company_name) VALUES (?)");
            $stmt->bind_param("s", $company_name);
            if (!$stmt->execute()) throw new Exception("Failed to insert into company_information.");
        }

        // Insert into place_of_work table
        $local_place = $_POST['local_place'] ?? null;
        $abroad_place = $_POST['abroad_place'] ?? null;
        $stmt = $conn->prepare("INSERT INTO place_of_work (local_place, abroad_place) VALUES (?, ?)");
        $stmt->bind_param("ss", $local_place, $abroad_place);
        if (!$stmt->execute()) throw new Exception("Failed to insert into place_of_work.");

        // Insert into first_job_after_college table
        $is_first_job = $_POST['is_first_job'] ?? null;
        if ($is_first_job) {
            $stmt = $conn->prepare("INSERT INTO first_job_after_college (is_first_job) VALUES (?)");
            $stmt->bind_param("s", $is_first_job);
            if (!$stmt->execute()) throw new Exception("Failed to insert into first_job_after_college.");
        }

        // Insert into reasons_staying table (if applicable)
        if (isset($_POST['reason_staying']) && is_array($_POST['reason_staying'])) {
            $reason_staying = $_POST['reason_staying'];
            $other_reason_staying = $_POST['other_reason_staying'] ?? null;
            foreach ($reason_staying as $reason) {
                $stmt = $conn->prepare("INSERT INTO reasons_staying (reason_staying, other_reason) VALUES (?, ?)");
                $stmt->bind_param("ss", $reason, $other_reason_staying);
                if (!$stmt->execute()) throw new Exception("Failed to insert into reasons_staying.");
            }
        }

        // Insert into first_job_related_to_course table
        $is_related_to_course = $_POST['is_related_to_course'] ?? null;
        if ($is_related_to_course) {
            $stmt = $conn->prepare("INSERT INTO first_job_related_to_course (is_related) VALUES (?)");
            $stmt->bind_param("s", $is_related_to_course);
            if (!$stmt->execute()) throw new Exception("Failed to insert into first_job_related_to_course.");
        }

        // Insert into reasons_accepting table (if applicable)
        if (isset($_POST['reason_accepting']) && is_array($_POST['reason_accepting'])) {
            $reason_accepting = $_POST['reason_accepting'];
            $other_reason_accepting = $_POST['other_reason_accepting'] ?? null;
            foreach ($reason_accepting as $reason) {
                $stmt = $conn->prepare("INSERT INTO reasons_accepting (reason_accepting, other_reason) VALUES (?, ?)");
                $stmt->bind_param("ss", $reason, $other_reason_accepting);
                if (!$stmt->execute()) throw new Exception("Failed to insert into reasons_accepting.");
            }
        }

        // Insert into reasons_changing table (if applicable)
        if (isset($_POST['reason_changing']) && is_array($_POST['reason_changing'])) {
            $reason_changing = $_POST['reason_changing'];
            $other_reason_changing = $_POST['other_reason_changing'] ?? null;
            foreach ($reason_changing as $reason) {
                $stmt = $conn->prepare("INSERT INTO reasons_changing (reason_changing, other_reason) VALUES (?, ?)");
                $stmt->bind_param("ss", $reason, $other_reason_changing);
                if (!$stmt->execute()) throw new Exception("Failed to insert into reasons_changing.");
            }
        }

        // Insert into first_job_duration table
        $first_job_duration = $_POST['first_job_duration'] ?? null;
        $other_duration = $_POST['other_duration'] ?? null;
        if ($first_job_duration) {
            $stmt = $conn->prepare("INSERT INTO first_job_duration (first_job_duration, other_duration) VALUES (?, ?)");
            $stmt->bind_param("ss", $first_job_duration, $other_duration);
            if (!$stmt->execute()) throw new Exception("Failed to insert into first_job_duration.");
        }

        // Insert into job_finding_methods table (if applicable)
        if (isset($_POST['job_finding_method']) && is_array($_POST['job_finding_method'])) {
            $job_finding_method = $_POST['job_finding_method'];
            $other_method = $_POST['other_method'] ?? null;
            foreach ($job_finding_method as $method) {
                $stmt = $conn->prepare("INSERT INTO job_finding_methods (job_finding_method, other_method) VALUES (?, ?)");
                $stmt->bind_param("ss", $method, $other_method);
                if (!$stmt->execute()) throw new Exception("Failed to insert into job_finding_methods.");
            }
        }

        // Insert into time_to_land_first_job table
        $time_to_first_job = $_POST['time_to_first_job'] ?? null;
        $other_time = $_POST['other_time'] ?? null;
        if ($time_to_first_job) {
            $stmt = $conn->prepare("INSERT INTO time_to_land_first_job (time_to_first_job, other_time) VALUES (?, ?)");
            $stmt->bind_param("ss", $time_to_first_job, $other_time);
            if (!$stmt->execute()) throw new Exception("Failed to insert into time_to_land_first_job.");
        }

        // Insert into job_positions table
        $first_job = $_POST['first_job'] ?? null;
        $current_job = $_POST['current_job'] ?? null;
        if ($first_job) {
            $stmt = $conn->prepare("INSERT INTO job_positions (first_job, current_job) VALUES (?, ?)");
            $stmt->bind_param("ss", $first_job, $current_job);
            if (!$stmt->execute()) throw new Exception("Failed to insert into job_positions.");
        }

                // Insert into initial_gross_monthly_earning table
        $initial_earning = $_POST['initial_earning'] ?? null;
        if ($initial_earning) {
            $stmt = $conn->prepare("INSERT INTO initial_gross_monthly_earning (initial_earning) VALUES (?)");
            $stmt->bind_param("d", $initial_earning);
            if (!$stmt->execute()) throw new Exception("Failed to insert into initial_gross_monthly_earning.");
        }

        // Insert into curriculum_relevance table
        $is_relevant = $_POST['is_relevant'] ?? null;
        if ($is_relevant) {
            $stmt = $conn->prepare("INSERT INTO curriculum_relevance (is_relevant) VALUES (?)");
            $stmt->bind_param("s", $is_relevant);
            if (!$stmt->execute()) throw new Exception("Failed to insert into curriculum_relevance.");
        }

        // Insert into useful_competencies table
        if (isset($_POST['useful_competencies']) && is_array($_POST['useful_competencies'])) {
            $useful_competencies = $_POST['useful_competencies'];
            $other_competency = $_POST['other_competency'] ?? null;
            foreach ($useful_competencies as $competency) {
                $stmt = $conn->prepare("INSERT INTO useful_competencies (useful_competencies, other_competency) VALUES (?, ?)");
                $stmt->bind_param("ss", $competency, $other_competency);
                if (!$stmt->execute()) throw new Exception("Failed to insert into useful_competencies.");
            }
        }

        // Insert into curriculum_improvement table
        $suggestions = $_POST['suggestions'] ?? null;
        if ($suggestions) {
            $stmt = $conn->prepare("INSERT INTO curriculum_improvement (suggestions) VALUES (?)");
            $stmt->bind_param("s", $suggestions);
            if (!$stmt->execute()) throw new Exception("Failed to insert into curriculum_improvement.");
        }

        // Insert into values_learned table
        if (isset($_POST['values_learned']) && is_array($_POST['values_learned'])) {
            $values_learned = $_POST['values_learned'];
            $other_value = $_POST['other_value'] ?? null;
            foreach ($values_learned as $value) {
                $stmt = $conn->prepare("INSERT INTO values_learned (values_learned, other_value) VALUES (?, ?)");
                $stmt->bind_param("ss", $value, $other_value);
                if (!$stmt->execute()) throw new Exception("Failed to insert into values_learned.");
            }
        }

        // Insert into community_services table
        $services = $_POST['services'] ?? null;
        if ($services) {
            $stmt = $conn->prepare("INSERT INTO community_services (services) VALUES (?)");
            $stmt->bind_param("s", $services);
            if (!$stmt->execute()) throw new Exception("Failed to insert into community_services.");
        }

        // Insert into best_features table
        if (isset($_POST['best_features']) && is_array($_POST['best_features'])) {
            $best_features = $_POST['best_features'];
            $other_feature = $_POST['other_feature'] ?? null;
            foreach ($best_features as $feature) {
                $stmt = $conn->prepare("INSERT INTO best_features (best_features, other_feature) VALUES (?, ?)");
                $stmt->bind_param("ss", $feature, $other_feature);
                if (!$stmt->execute()) throw new Exception("Failed to insert into best_features.");
            }
        }

    } catch (Exception $e) {
        // Rollback transaction in case of error
        $conn->rollback();
        echo json_encode(['error' => $e->getMessage()]);
    }

} else {
    echo json_encode(['error' => 'Invalid request method']);
}

$conn->close();
?>