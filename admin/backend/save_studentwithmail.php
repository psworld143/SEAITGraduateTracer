<?php
include('../db_conn.php');
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set response header
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Debug: Log received data
    error_log("Received POST data: " . print_r($_POST, true));

    try {
        // Test database connection
        if ($conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }

        // Get and validate basic required data
        $schoolID = $_POST['schoolID'] ?? '';
        $fullName = $_POST['fullName'] ?? '';
        $email = $_POST['email'] ?? '';
        $course = $_POST['course'] ?? '';
        $departmentCode = $_POST['departmentCode'] ?? '';
        $controlCode = $_POST['controlCode'] ?? '';
        $batch_id = $_POST['batch_id'] ?? 0;

        if (empty($schoolID) || empty($fullName) || empty($email)) {
            throw new Exception("Missing required fields");
        }

        // Generate simple token
        $activation_token = bin2hex(random_bytes(16));
        $token_expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

        // First, just try to insert basic data
        $sql = "INSERT INTO students (
            school_id, 
            full_name, 
            email, 
            course,
            department_code,
            control_code,
            batch_id,
            activation_token,
            token_expiration,
            status
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending')";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("sssssssss", 
            $schoolID,
            $fullName,
            $email,
            $course,
            $departmentCode,
            $controlCode,
            $batch_id,
            $activation_token,
            $token_expiration
        );

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        // If insert successful, try to send email
        $mail = new PHPMailer(true);
        
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'marotabdul@gmail.com';
        $mail->Password = 'htbf mtxr tytj vuku';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port = 465;

        $mail->setFrom('marotabdul@gmail.com', 'School Admin');
        $mail->addAddress($email, $fullName);

        $mail->isHTML(true);
        $mail->Subject = 'Account Activation';
        $activationLink = "http://localhost/seaitgraduatetracer_v2/register?token=$activation_token";
        $mail->Body = "Hello $fullName,<br><br>Please click here to activate your account: <a href='$activationLink'>Activate Account</a>";

        $mail->send();

        echo json_encode([
            'success' => true,
            'message' => 'Registration successful'
        ]);

    } catch (Exception $e) {
        // Log the error with full details
        error_log("Error in student registration: " . $e->getMessage());
        error_log("Stack trace: " . $e->getTraceAsString());

        echo json_encode([
            'success' => false,
            'message' => 'Registration failed: ' . $e->getMessage(),
            'details' => $e->getTraceAsString()
        ]);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        if (isset($conn)) {
            $conn->close();
        }
    }
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Invalid request method'
    ]);
}
?>