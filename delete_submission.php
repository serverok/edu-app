<?php
session_start();
include 'config/db.php';

// Check if admin is logged in
if (!isset($_SESSION['admin']) || $_SESSION['admin'] !== true) {
    header("Location: admin.php");
    exit;
}

// Get submission ID from URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Prepare SQL statement to delete the submission
        $stmt = $conn->prepare("DELETE FROM submissions WHERE id = ?");
        $stmt->execute([$id]);

        // Check if the deletion was successful
        if ($stmt->rowCount() > 0) {
            $_SESSION['message'] = "Submission deleted successfully.";
            $_SESSION['message_type'] = 'success';
        } else {
            $_SESSION['message'] = "Submission not found.";
            $_SESSION['message_type'] = 'danger';
        }
    } catch (PDOException $e) {
        $_SESSION['message'] = "Error deleting submission: " . $e->getMessage();
        $_SESSION['message_type'] = 'danger';
    }
} else {
    $_SESSION['message'] = "Invalid submission ID.";
    $_SESSION['message_type'] = 'danger';
}

// Redirect back to admin.php
header("Location: admin.php");
exit;
?>