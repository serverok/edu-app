<?php
// Database configuration
$servername = "localhost";
$username = "root"; // Change this to your actual database username
$password = ""; // Change this to your actual database password
$dbname = "college_finder";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Database created successfully or already exists<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
}

// Connect to the database
$conn = new mysqli($servername, $username, $password, $dbname);

// Create submissions table
$sql = "CREATE TABLE IF NOT EXISTS submissions (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    mobile VARCHAR(20) NOT NULL,
    education VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    country VARCHAR(100) NOT NULL,
    budget VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'submissions' created successfully or already exists<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create universities table with sample data
$sql = "CREATE TABLE IF NOT EXISTS universities (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    country VARCHAR(100) NOT NULL,
    ranking INT(11) NOT NULL,
    indian_students INT(11) NOT NULL,
    course_duration VARCHAR(50) NOT NULL,
    course_fee VARCHAR(100) NOT NULL,
    accommodation VARCHAR(100) NOT NULL,
    food VARCHAR(100) NOT NULL,
    budget_category VARCHAR(100) NOT NULL
)";

if ($conn->query($sql) === TRUE) {
    echo "Table 'universities' created successfully or already exists<br>";
    
    // Check if universities table is empty
    $result = $conn->query("SELECT COUNT(*) as count FROM universities");
    $row = $result->fetch_assoc();
    
    if ($row['count'] == 0) {
        // Insert sample universities
        $universities = [
            [
                'name' => 'Tashkent Medical Academy',
                'country' => 'Uzbekistan',
                'ranking' => 4662,
                'indian_students' => 300,
                'course_duration' => '6 years',
                'course_fee' => '₹2.97 Lakhs/year',
                'accommodation' => '5000 /month',
                'food' => '₹8000 /month',
                'budget_category' => '₹1-3 Lakhs/year'
            ],
            [
                'name' => 'Andijan State Medical Institute',
                'country' => 'Uzbekistan',
                'ranking' => 5044,
                'indian_students' => 500,
                'course_duration' => '6 years',
                'course_fee' => '₹2.97 Lakhs/year',
                'accommodation' => '4250 /month',
                'food' => '₹10200 /month',
                'budget_category' => '₹1-3 Lakhs/year'
            ],
            [
                'name' => 'Akaki Tsereteli State University',
                'country' => 'Georgia',
                'ranking' => 7734,
                'indian_students' => 400,
                'course_duration' => '6 years',
                'course_fee' => '₹3.4 Lakhs/year',
                'accommodation' => '14000 /month',
                'food' => '₹12000 /month',
                'budget_category' => '₹4-6 Lakhs/year'
            ],
            [
                'name' => 'Tbilisi State Medical University',
                'country' => 'Georgia',
                'ranking' => 6820,
                'indian_students' => 600,
                'course_duration' => '6 years',
                'course_fee' => '₹4.2 Lakhs/year',
                'accommodation' => '15000 /month',
                'food' => '₹13000 /month',
                'budget_category' => '₹4-6 Lakhs/year'
            ],
            [
                'name' => 'Carol Davila University of Medicine',
                'country' => 'Romania',
                'ranking' => 3500,
                'indian_students' => 200,
                'course_duration' => '6 years',
                'course_fee' => '₹6.5 Lakhs/year',
                'accommodation' => '18000 /month',
                'food' => '₹15000 /month',
                'budget_category' => 'Above ₹6 Lakhs/year'
            ],
            [
                'name' => 'Medical University of Sofia',
                'country' => 'Bulgaria',
                'ranking' => 3250,
                'indian_students' => 250,
                'course_duration' => '6 years',
                'course_fee' => '₹7.2 Lakhs/year',
                'accommodation' => '20000 /month',
                'food' => '₹16000 /month',
                'budget_category' => 'Above ₹6 Lakhs/year'
            ]
        ];
        
        foreach ($universities as $university) {
            $stmt = $conn->prepare("INSERT INTO universities (name, country, ranking, indian_students, course_duration, course_fee, accommodation, food, budget_category) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiisssss", 
                $university['name'], 
                $university['country'], 
                $university['ranking'], 
                $university['indian_students'], 
                $university['course_duration'], 
                $university['course_fee'], 
                $university['accommodation'], 
                $university['food'], 
                $university['budget_category']
            );
            
            if ($stmt->execute()) {
                echo "Inserted university: " . $university['name'] . "<br>";
            } else {
                echo "Error inserting university: " . $stmt->error . "<br>";
            }
            
            $stmt->close();
        }
    } else {
        echo "Sample universities already exist in the database<br>";
    }
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

echo "<p>Setup completed. <a href='index.php'>Visit the website</a></p>";

$conn->close();
?>
