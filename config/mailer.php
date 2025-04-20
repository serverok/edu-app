<?php
// For development environment, we'll use a simplified email function
// In production, this would be replaced with PHPMailer or other robust email solution

function sendEmail($name, $email, $mobile, $education, $location, $country, $budget) {
    // In a development environment, we'll just simulate success
    // and log the email data
    
    $emailData = [
        'to' => 'serverok.in@gmail.com',
        'subject' => 'New Form Submission - 4inDegree',
        'name' => $name,
        'email' => $email,
        'mobile' => $mobile,
        'education' => $education,
        'location' => $location,
        'country' => $country,
        'budget' => $budget,
        'timestamp' => date('Y-m-d H:i:s')
    ];
    
    // Log the email data for development purposes
    error_log('Simulation: Email would be sent with data: ' . json_encode($emailData));
    
    // In production, this would use PHPMailer or other email service
    // For now, we return success to simulate email sending
    return true;
}
?>
