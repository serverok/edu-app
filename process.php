<?php
// Start output buffering to prevent headers already sent errors
ob_start();

session_start();
include 'config/db.php';
include 'config/mailer.php';

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] != "POST") {
    header("Location: form.php");
    exit;
}

// Validate form data - using modern PHP 8+ sanitization
$name = isset($_POST['name']) ? htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8') : '';
$email = isset($_POST['email']) ? filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL) : '';
$mobile = isset($_POST['mobile']) ? htmlspecialchars($_POST['mobile'], ENT_QUOTES, 'UTF-8') : '';
$education = isset($_POST['education']) ? htmlspecialchars($_POST['education'], ENT_QUOTES, 'UTF-8') : '';
$location = isset($_POST['location']) ? htmlspecialchars($_POST['location'], ENT_QUOTES, 'UTF-8') : '';
$country = isset($_POST['country']) ? htmlspecialchars($_POST['country'], ENT_QUOTES, 'UTF-8') : '';
$budget = isset($_POST['budget']) ? htmlspecialchars($_POST['budget'], ENT_QUOTES, 'UTF-8') : '';

// Validate input
if (empty($name) || empty($email) || empty($mobile) || empty($education) || empty($location) || empty($country) || empty($budget)) {
    $_SESSION['error'] = "All fields are required";
    header("Location: form.php");
    exit;
}

// Store user data in session for results page
$_SESSION['user_data'] = [
    'name' => $name,
    'email' => $email,
    'mobile' => $mobile,
    'education' => $education,
    'location' => $location
];

try {
    // Get database connection from db.php
    global $conn;
    
    // For debugging purposes, log the connection and data
    error_log("Database Connection: " . (isset($conn) ? "Connected" : "Not Connected"));
    error_log("Data: " . json_encode([
        'name' => $name,
        'email' => $email, 
        'mobile' => $mobile,
        'education' => $education,
        'location' => $location,
        'country' => $country,
        'budget' => $budget
    ]));
    
    // Store submission in database using PDO
    $stmt = $conn->prepare("INSERT INTO submissions (name, email, mobile, education, location, country, budget) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $mobile, $education, $location, $country, $budget]);
    
    // Send email notification
    $emailResult = sendEmail($name, $email, $mobile, $education, $location, $country, $budget);
    
    if ($emailResult === true) {
        $_SESSION['success'] = "Your submission has been received. We'll be in touch soon.";
    } else {
        $_SESSION['warning'] = "Your submission was saved, but we couldn't send the email notification: " . $emailResult;
    }
    
    // Redirect to results page
    header("Location: results.php");
    exit;
} catch (PDOException $e) {
    $_SESSION['error'] = "Database Error: " . $e->getMessage();
    header("Location: form.php");
    exit;
} catch (Exception $e) {
    $_SESSION['error'] = "Error: " . $e->getMessage();
    header("Location: form.php");
    exit;
}
