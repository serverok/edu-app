<?php
session_start();

// Check if coming from budget selection
if (!isset($_POST['selectedBudget']) && !isset($_SESSION['budget'])) {
    header("Location: budget.php");
    exit;
}

// Store budget in session
if (isset($_POST['selectedBudget'])) {
    $_SESSION['budget'] = $_POST['selectedBudget'];
}

// Store country in session if coming from budget page
if (isset($_POST['country'])) {
    $_SESSION['country'] = $_POST['country'];
}

// Get reCAPTCHA site key from environment variables
$recaptchaSiteKey = getenv('RECAPTCHA_SITE_KEY');

include 'includes/header.php';
?>

<div class="form-container">
    <div class="progress-container">
        <div class="progress-steps">
            <div class="step completed">1</div>
            <div class="step completed">2</div>
            <div class="step active">3</div>
            <div class="active-progress" style="width: 90%"></div>
        </div>
    </div>

    <h2 class="step-heading">Fill out the following details</h2>
    <p class="step-subheading">To get shortlisted universities on your WhatsApp</p>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mb-4">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="process.php" method="post" id="personalForm">
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
            <small id="nameError" class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
            <small id="emailError" class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="mobile" class="form-label">Mobile</label>
            <div class="input-group">
                <select class="form-select" id="countryCode" name="countryCode" required>
                    <option value="+91" selected>🇮🇳 +91 (India)</option>
                    <option value="+1">🇺🇸 +1 (USA)</option>
                    <option value="+44">🇬🇧 +44 (UK)</option>
                    <option value="+61">🇦🇺 +61 (Australia)</option>
                    <option value="+81">🇯🇵 +81 (Japan)</option>
                    <option value="+86">🇨🇳 +86 (China)</option>
                    <option value="+49">🇩🇪 +49 (Germany)</option>
                    <option value="+33">🇫🇷 +33 (France)</option>
                    <option value="+7">🇷🇺 +7 (Russia)</option>
                </select>
                <input type="text" class="form-control" id="mobile" name="mobile" required>
            </div>
            <small id="mobileError" class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="education" class="form-label">Education</label>
            <select class="form-select" id="education" name="education" required>
                <option value="" selected disabled>Education...</option>
                <option value="NEET Preparation">NEET Preparation</option>
                <option value="12th Bio Science">12th Bio Science</option>
                <option value="12th Computer Science">12th Computer Science</option>
                <option value="11th">11th </option>
                <option value="10th">10th</option>
                <option value="other">other</option>
            </select>
            <small id="educationError" class="text-danger"></small>
        </div>

        <div class="mb-3">
            <label for="location" class="form-label">Your Place</label>
            <input type="text" class="form-control" id="location" name="location" required>
            <small id="locationError" class="text-danger"></small>
        </div>

        <input type="hidden" name="country" value="<?php echo $_SESSION['country']; ?>">
        <input type="hidden" name="budget" value="<?php echo $_SESSION['budget']; ?>">
        
        <div class="text-center mt-4">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="action-btn w-100">Find Best University</button>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include 'includes/footer.php'; ?>
