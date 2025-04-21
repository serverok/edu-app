<?php
session_start();
include 'config/db.php';

// Basic admin authentication
$admin_username = "admin";
$admin_password = "admin123"; // Change this to a secure password in production

// Check if admin is logged in
$is_logged_in = false;

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    if ($username === $admin_username && $password === $admin_password) {
        $_SESSION['admin'] = true;
        $is_logged_in = true;
    } else {
        $login_error = "Invalid username or password";
    }
} elseif (isset($_SESSION['admin']) && $_SESSION['admin'] === true) {
    $is_logged_in = true;
}

// Logout action
if (isset($_GET['logout'])) {
    unset($_SESSION['admin']);
    header("Location: admin.php");
    exit;
}

// Get submissions from database
$submissions = [];
if ($is_logged_in) {
    $stmt = $conn->query("SELECT * FROM submissions ORDER BY created_at DESC");
    $submissions = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Educart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .admin-container {
            max-width: 1200px;
            margin: 30px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .table-responsive {
            overflow-x: auto;
        }
        .logo {
            font-weight: 700;
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php if (!$is_logged_in): ?>
            <!-- Login Form -->
            <div class="login-container">
                <h2 class="text-center mb-4">Edu<span class="text-success">Cart</span> Admin</h2>
                <?php if (isset($login_error)): ?>
                    <div class="alert alert-danger"><?php echo $login_error; ?></div>
                <?php endif; ?>
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" name="login" class="btn btn-success">Login</button>
                    </div>
                </form>
            </div>
        <?php else: ?>
            <!-- Admin Dashboard -->
            <div class="admin-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2>Edu<span class="text-success">Cart</span> Admin Dashboard</h2>
                    <a href="?logout=1" class="btn btn-outline-danger"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </div>
                
                <div class="card mb-4">
                    <div class="card-header bg-success text-white">
                        <h5 class="mb-0">Form Submissions</h5>
                    </div>
                    <div class="card-body">
                        <?php if (count($submissions) > 0): ?>
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>Education</th>
                                            <th>Location</th>
                                            <th>Country</th>
                                            <th>Budget</th>
                                            <th>Date</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($submissions as $submission): ?>
                                            <tr>
                                                <td><?php echo $submission['id']; ?></td>
                                                <td><?php echo htmlspecialchars($submission['name']); ?></td>
                                                <td><?php echo htmlspecialchars($submission['email']); ?></td>
                                                <td><?php echo htmlspecialchars($submission['mobile']); ?></td>
                                                <td><?php echo htmlspecialchars($submission['education']); ?></td>
                                                <td><?php echo htmlspecialchars($submission['location']); ?></td>
                                                <td><?php echo htmlspecialchars($submission['country']); ?></td>
                                                <td><?php echo htmlspecialchars($submission['budget']); ?></td>
                                                <td><?php echo date('M d, Y H:i', strtotime($submission['created_at'])); ?></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        <?php else: ?>
                            <div class="alert alert-info">No submissions found.</div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
