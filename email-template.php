<?php
// Output messages
$response = '';
// Check if the form was submitted
if (isset($_POST['rating'], $_POST['hear_about_us'], $_POST['contact_pref'], $_POST['email'], $_POST['comments'], $_POST['recommend'])) {
	// Process form data 
	// Assign POST variables
	$rating = $_POST['rating'];
	$hear_about_us = $_POST['hear_about_us'];
	$contact_pref = implode(', ', $_POST['contact_pref']);
	$email = $_POST['email'];
	$comments = $_POST['comments'];
	$recommend = $_POST['recommend'];
	// Where to send the mail? It should be your email address
	$to      = 'surveys@yourwebsite.com';
	// Mail from
	$from    = 'noreply@yourwebsite.com';
	// Mail subject
	$subject = 'A user has submitted a survey';
	// Mail headers
	$headers = 'From: ' . $from . "\r\n" . 'Reply-To: ' . $from . "\r\n" . 'Return-Path: ' . $from . "\r\n" . 'X-Mailer: PHP/' . phpversion() . "\r\n" . 'MIME-Version: 1.0' . "\r\n" . 'Content-Type: text/html; charset=UTF-8' . "\r\n";
	// Capture the email template file as a string
	ob_start();
	include 'email-template.php';
	$email_template = ob_get_clean();
	// Try to send the mail
	if (mail($to, $subject, $email_template, $headers)) {
		// Success
		$response = '<h3>Thank You!</h3><p>With your help, we can improve our services for all our trusted members.</p>';		
	} else {
		// Fail
		$response = '<h3>Error!</h3><p>Message could not be sent! Please check your mail server settings!</a>';
	}
}
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,minimum-scale=1">
		<title>Survey</title>
	</head>
	<body style="background-color:#F5F6F8;font-family:-apple-system, BlinkMacSystemFont, 'segoe ui', roboto, oxygen, ubuntu, cantarell, 'fira sans', 'droid sans', 'helvetica neue', Arial, sans-serif;box-sizing:border-box;font-size:16px;">
		<div style="background-color:#fff;margin:30px;box-sizing:border-box;font-size:16px;">
			<h1 style="padding:40px;box-sizing:border-box;font-size:24px;color:#ffffff;background-color:#cb5f51;margin:0;">Survey</h1>
			<p style="padding:40px 40px 20px 40px;margin:0;box-sizing:border-box;font-size:16px;">A user has submitted a survey.</p>
			<h2 style="padding:20px 40px;margin:0;color:#394453;box-sizing:border-box;">Survey Results</h2>
			<div style="box-sizing:border-box;padding:0 40px 20px;">
				<table style="border-collapse:collapse;width:100%;">
					<tbody>
						<tr>
							<td style="padding:15px 0;text-decoration:underline;">Email</td>
							<td style="text-align:right;"><?=$email?></td>
						</tr>
						<tr>
							<td style="padding:15px 0;text-decoration:underline;">Comments</td>
							<td style="text-align:right;"><?=htmlspecialchars($comments, ENT_QUOTES)?></td>
						</tr>
						<tr>
							<td style="padding:15px 0;text-decoration:underline;">How would you rate your experience with us?</td>
							<td style="text-align:right;"><?=htmlspecialchars($rating, ENT_QUOTES)?></td>
						</tr>
						<tr>
							<td style="padding:15px 0;text-decoration:underline;">Where did you hear about us?</td>
							<td style="text-align:right;"><?=htmlspecialchars($hear_about_us, ENT_QUOTES)?></td>
						</tr>
						<tr>
							<td style="padding:15px 0;text-decoration:underline;">How likely are you to recommend us?</td>
							<td style="text-align:right;"><?=htmlspecialchars($recommend, ENT_QUOTES)?></td>
						</tr>
						<tr>
							<td style="padding:15px 0;text-decoration:underline;">How would you like us to respond to you?</td>
							<td style="text-align:right;"><?=htmlspecialchars($contact_pref, ENT_QUOTES)?></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</body>
</html>