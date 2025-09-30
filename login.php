<?php
// Start the session
session_start();

// Include the database connection
require_once 'db_conn.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the login form data
    $usernameOrEmail = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validate that both fields are filled
    if (empty($usernameOrEmail) || empty($password)) {
        echo "Please enter both username/email and password.";
        exit;
    }

    // Sanitize inputs
    $usernameOrEmail = htmlspecialchars($usernameOrEmail, ENT_QUOTES, 'UTF-8');
    $password = htmlspecialchars($password, ENT_QUOTES, 'UTF-8');

    // Check if the input is an email (for students) or username (for regular users)
    if (filter_var($usernameOrEmail, FILTER_VALIDATE_EMAIL)) {
        // Query the `students` table to check if a student is logging in
        $stmt = $conn->prepare("SELECT id, full_name, email, password_hash, account_status FROM students WHERE email = ?");
        $stmt->bind_param("s", $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch student data
            $student = $result->fetch_assoc();

            // Check if the student's account is active
            if ($student['account_status'] !== 'active') {
                echo "Your account is not active. Please check your email for activation.";
                exit;
            }

            // Verify the password
            if (password_verify($password, $student['password_hash'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $student['id'];
                $_SESSION['user_type'] = 'student';
                $_SESSION['student_name'] = $student['full_name'];
                $_SESSION['student_email'] = $student['email'];

                // Redirect to the student dashboard
                echo "Location: Static/index.php";
                exit;
            } else {
                echo "Invalid password. Please try again.";
                exit;
            }
        } else {
            echo "Email not found in the student database.";
            exit;
        }
    } else {
        // Query the `users` table to check if a regular user is logging in
        $stmt = $conn->prepare("SELECT id, firstname, lastname, username, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $usernameOrEmail);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Fetch user data
            $user = $result->fetch_assoc();

            // Verify the password
            if (password_verify($password, $user['password'])) {
                // Password is correct, set session variables
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_type'] = 'regular_user';
                $_SESSION['user_name'] = $user['firstname'] . ' ' . $user['lastname'];

                // Redirect to the regular user dashboard
                echo "Location: admin/index.php";
                exit;
            } else {
                echo "Invalid password. Please try again.";
                exit;
            }
        } else {
            echo "Username not found in the users database.";
            exit;
        }
    }
}
?>
