<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "graduate_tracer";

// Create a new MySQLi connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die(json_encode(['status' => 'error', 'message' => 'Connection failed: ' . $conn->connect_error]));
}
// Get JSON data
$data = json_decode($_POST['questionsData'], true);

// Function to save data into the database
function saveData($conn, $table, $data) {
    $columns = implode(", ", array_keys($data));
    $values = implode(", ", array_map(function ($value) use ($conn) {
        return "'" . $conn->real_escape_string($value) . "'";
    }, $data));

    $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

    if ($conn->query($sql) === TRUE) {
        return $conn->insert_id; // Return the inserted ID
    } else {
        return "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Save data to each table
$results = [];
if (!empty($data['best_features'])) {
    $results['best_features'] = saveData($conn, 'best_features', $data['best_features']);
}
if (!empty($data['community_services'])) {
    $results['community_services'] = saveData($conn, 'community_services', $data['community_services']);
}
if (!empty($data['company_name'])) {
    $results['company_name'] = saveData($conn, 'company_name', $data['company_name']);
}
if (!empty($data['current_occupation'])) {
    $results['current_occupation'] = saveData($conn, 'current_occupation', $data['current_occupation']);
}
if (!empty($data['curriculum_improvement'])) {
    $results['curriculum_improvement'] = saveData($conn, 'curriculum_improvement', $data['curriculum_improvement']);
}
if (!empty($data['curriculum_relevance'])) {
    $results['curriculum_relevance'] = saveData($conn, 'curriculum_relevance', $data['curriculum_relevance']);
}
if (!empty($data['educational_attainment'])) {
    $results['educational_attainment'] = saveData($conn, 'educational_attainment', $data['educational_attainment']);
}
if (!empty($data['employment_status'])) {
    $results['employment_status'] = saveData($conn, 'employment_status', $data['employment_status']);
}
if (!empty($data['first_job_after_college'])) {
    $results['first_job_after_college'] = saveData($conn, 'first_job_after_college', $data['first_job_after_college']);
}
if (!empty($data['first_job_duration'])) {
    $results['first_job_duration'] = saveData($conn, 'first_job_duration', $data['first_job_duration']);
}
if (!empty($data['general_information'])) {
    $results['general_information'] = saveData($conn, 'general_information', $data['general_information']);
}
if (!empty($data['initial_earning'])) {
    $results['initial_earning'] = saveData($conn, 'initial_earning', $data['initial_earning']);
}
if (!empty($data['job_finding_method'])) {
    $results['job_finding_method'] = saveData($conn, 'job_finding_method', $data['job_finding_method']);
}
if (!empty($data['job_position'])) {
    $results['job_position'] = saveData($conn, 'job_position', $data['job_position']);
}
if (!empty($data['job_relatedness'])) {
    $results['job_relatedness'] = saveData($conn, 'job_relatedness', $data['job_relatedness']);
}
if (!empty($data['place_of_work'])) {
    $results['place_of_work'] = saveData($conn, 'place_of_work', $data['place_of_work']);
}
if (!empty($data['professional_qualification'])) {
    $results['professional_qualification'] = saveData($conn, 'professional_qualification', $data['professional_qualification']);
}
if (!empty($data['skills'])) {
    $results['skills'] = saveData($conn, 'skills', $data['skills']);
}
if (!empty($data['testimonials'])) {
    $results['testimonials'] = saveData($conn, 'testimonials', $data['testimonials']);
}
if (!empty($data['work_duration'])) {
    $results['work_duration'] = saveData($conn, 'work_duration', $data['work_duration']);
}

// Save employment sector data
if (!empty($data['employment_sector'])) {
    $results['employment_sector'] = saveData($conn, 'employment_sector', $data['employment_sector']);
}

// Close connection
$conn->close();

// Return response
echo json_encode($results);
?>