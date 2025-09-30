<?php
// Include database connection
require_once 'db_conn.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Prepare query to validate token and check if it's for a pending account
    $stmt = $conn->prepare("SELECT id, token_expiration FROM students WHERE activation_token = ? AND account_status = 'pending'");
    $stmt->bind_param("s", $token);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the token exists and if it's still valid
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Check if the token has expired
        if (strtotime($row['token_expiration']) > time()) {
            // Show the password reset form
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $newPassword = $_POST['password'];

                // Validate password strength
                if (strlen($newPassword) < 8) {
                    echo "Password must be at least 8 characters long.";
                    return;
                }

                // Hash the new password
                $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

                try {
                    // Update the password and remove the activation token
                    $updateStmt = $conn->prepare("UPDATE students SET password_hash = ?, activation_token = NULL, account_status = 'active' WHERE id = ?");
                    $updateStmt->bind_param("si", $hashedPassword, $row['id']);
                    $updateStmt->execute();

                    // Redirect to login page after successful activation
                    header("http://localhost/SEAITGraduateTracer/index2.php?activation=success");
                    exit();
                } catch (Exception $e) {
                    echo "Error: " . $e->getMessage();
                }
            }
        } else {
            echo "Activation link expired.";
        }
    } else {
        echo "Invalid activation link.";
    }
} else {
    echo "No activation token provided.";
}
?>
