<?php
include('../db_conn.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    error_log("Received POST data: " . print_r($_POST, true));

    try {
        if ($conn->connect_error) {
            throw new Exception("Database connection failed: " . $conn->connect_error);
        }

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

        $schoolID = htmlspecialchars($schoolID, ENT_QUOTES, 'UTF-8');
        $fullName = htmlspecialchars($fullName, ENT_QUOTES, 'UTF-8');
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $course = htmlspecialchars($course, ENT_QUOTES, 'UTF-8');
        $departmentCode = htmlspecialchars($departmentCode, ENT_QUOTES, 'UTF-8');
        $controlCode = htmlspecialchars($controlCode, ENT_QUOTES, 'UTF-8');
        $batch_id = intval($batch_id);

        // Default password
        $default_password = "Seait123";
        $password_hash = password_hash($default_password, PASSWORD_BCRYPT);

        $activation_token = bin2hex(random_bytes(16));
        $token_expiration = date('Y-m-d H:i:s', strtotime('+24 hours'));

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
            account_status,
            role,
            password_hash
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 'pending', 'student', ?)";

        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            throw new Exception("Prepare failed: " . $conn->error);
        }

        $stmt->bind_param("ssssssssss", 
            $schoolID,
            $fullName,
            $email,
            $course,
            $departmentCode,
            $controlCode,
            $batch_id,
            $activation_token,
            $token_expiration,
            $password_hash
        );

        if (!$stmt->execute()) {
            throw new Exception("Execute failed: " . $stmt->error);
        }

        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'cashperapadala@gmail.com';
            $mail->Password = 'khpm qerh ltcs adjv';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $mail->setFrom('SEAITGRADUATETRACER@gmail.com', 'no reply');
            $mail->addAddress($email, $fullName);

            $mail->isHTML(true);
            $mail->Subject = 'Registration Confirmation';
            $mail->Body = "Hello $fullName,<br><br>Thank you for registering. Please use this link to activate your account: <a href='http://localhost/SEAITGraduateTracer_v2/register.php?token=$activation_token'>Activate Account</a><br><br>Your initial password is <strong>Seait123</strong>. We recommend changing it after logging in.";

            $mail->send();
            echo json_encode([
                'success' => true,
                'message' => 'Student added successfully, and email sent'
            ]);
        } catch (Exception $e) {
            error_log("Mailer Error: " . $mail->ErrorInfo);
            echo json_encode([
                'success' => false,
                'error' => 'Student added but email could not be sent.'
            ]);
        }
    } catch (Exception $e) {
        error_log("Error: " . $e->getMessage());
        echo json_encode([
            'success' => false,
            'error' => $e->getMessage()
        ]);
    } finally {
        if (isset($stmt)) {
            $stmt->close();
        }
        $conn->close();
    }
} else {
    echo json_encode([
        'success' => false,
        'error' => 'Invalid request method'
    ]);
}

?>
