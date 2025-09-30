<?php
// Include database connection
include('../db_conn.php'); // Make sure this path is correct

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO job_postings (company_name, company_logo, job_title, job_location, job_description, qualifications, application_deadline, contact_info) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        // Get data from the form
        $companyName = $_POST['companyName'];
        $jobTitle = $_POST['jobTitle'];
        $jobLocation = $_POST['jobLocation'];
        $jobDescription = $_POST['jobDescription'];
        $qualifications = $_POST['qualifications'];
        $applicationDeadline = $_POST['applicationDeadline'];
        $contactInfo = $_POST['contactInfo'];

        // Handle file upload
        $companyLogo = null; // Default value
        if (isset($_FILES['companyLogo']) && $_FILES['companyLogo']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['companyLogo']['tmp_name'];
            $fileName = $_FILES['companyLogo']['name'];
            $fileSize = $_FILES['companyLogo']['size'];
            $fileType = $_FILES['companyLogo']['type'];
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

            // Validate file type
            if (in_array($fileType, $allowedTypes)) {
                $uploadDir = '../uploads/';
                $filePath = $uploadDir . basename($fileName);

                // Move the uploaded file to the specified directory
                if (move_uploaded_file($fileTmpPath, $filePath)) {
                    $companyLogo = $filePath;
                } else {
                    throw new Exception('File upload failed.');
                }
            } else {
                throw new Exception('Invalid file type. Only JPG, PNG and GIF files are allowed.');
            }
        }

        // Bind parameters and execute the statement
        $stmt->bind_param("ssssssss", $companyName, $companyLogo, $jobTitle, $jobLocation, $jobDescription, $qualifications, $applicationDeadline, $contactInfo);
        $stmt->execute();

        // Get the last inserted ID
        $lastId = $conn->insert_id;

        // Fetch the newly created row for the response
        $stmt = $conn->prepare("SELECT * FROM job_postings WHERE id = ?");
        $stmt->bind_param("i", $lastId);
        $stmt->execute();
        $result = $stmt->get_result();
        $newRow = $result->fetch_assoc();

        // Send a JSON response
        echo json_encode(['success' => true, 'message' => 'Job posting added successfully!', 'newRow' => $newRow]);

    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => $e->getMessage()]);
    } finally {
        $stmt->close();
        $conn->close();
    }
}
?>
