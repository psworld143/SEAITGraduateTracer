<?php
// Set response content type to JSON
header('Content-Type: application/json');

// Include the database connection file
include('../db_conn.php');

// Initialize response array
$response = ['success' => false, 'message' => ''];

try {
    // Check if the required POST parameters are set
    if (isset($_POST['editDocumentId'], $_POST['editDocumentType'], $_POST['editAvailabilityStatus'], $_POST['editReleaseDate'], $_POST['editAdditionalInstructions'])) {
        
        // Sanitize the input values
        $id = intval($_POST['editDocumentId']);
        $documentType = trim($conn->real_escape_string($_POST['editDocumentType']));
        $availabilityStatus = trim($conn->real_escape_string($_POST['editAvailabilityStatus']));
        $releaseDate = trim($conn->real_escape_string($_POST['editReleaseDate']));
        $additionalInstructions = trim($conn->real_escape_string($_POST['editAdditionalInstructions']));

        // Validate mandatory fields
        if (empty($documentType) || empty($availabilityStatus) || empty($releaseDate)) {
            throw new Exception('Please fill in all required fields.');
        }

        // Prepare the SQL update statement
        $stmt = $conn->prepare("UPDATE documents SET document_type = ?, availability_status = ?, release_date = ?, additional_instructions = ? WHERE id = ?");
        
        if (!$stmt) {
            throw new Exception('Database preparation error: ' . $conn->error);
        }

        $stmt->bind_param("ssssi", $documentType, $availabilityStatus, $releaseDate, $additionalInstructions, $id);

        // Execute the update query
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Document updated successfully.';
            } else {
                // The statement executed, but no rows were changed
                $response['success'] = false;
                $response['message'] = 'No changes made. The document may not exist or the data is the same.';
            }
        } else {
            throw new Exception('Update failed: ' . $stmt->error);
        }

        // Close the statement
        $stmt->close();
    } else {
        $response['success'] = false;
        $response['message'] = 'Required parameters are missing.';
    }
} catch (Exception $e) {
    $response['success'] = false;
    $response['message'] = $e->getMessage();
} finally {
    // Close the database connection
    $conn->close();
    
    // Return JSON response
    echo json_encode($response);
}
