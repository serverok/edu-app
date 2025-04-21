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
                <select class="form-select country-code-select" id="countryCode" name="countryCode" required>
                    <option value="">Select Country...</option>
                    <option value="+91" selected>🇮🇳 India (+91)</option>
                    <option value="+1">🇺🇸 United States (+1)</option>
                    <option value="+44">🇬🇧 United Kingdom (+44)</option>
                    <option value="+61">🇦🇺 Australia (+61)</option>
                    <option value="+81">🇯🇵 Japan (+81)</option>
                    <option value="+86">🇨🇳 China (+86)</option>
                    <option value="+49">🇩🇪 Germany (+49)</option>
                    <option value="+33">🇫🇷 France (+33)</option>
                    <option value="+7">🇷🇺 Russia (+7)</option>
                    <option value="+39">🇮🇹 Italy (+39)</option>
                    <option value="+34">🇪🇸 Spain (+34)</option>
                    <option value="+49">🇩🇪 Germany (+49)</option>
                    <option value="+41">🇨🇭 Switzerland (+41)</option>
                    <option value="+31">🇳🇱 Netherlands (+31)</option>
                    <option value="+45">🇩🇰 Denmark (+45)</option>
                    <option value="+47">🇳🇴 Norway (+47)</option>
                    <option value="+46">🇸🇪 Sweden (+46)</option>
                    <option value="+358">🇫🇮 Finland (+358)</option>
                    <option value="+353">🇮🇪 Ireland (+353)</option>
                    <option value="+352">🇱🇺 Luxembourg (+352)</option>
                    <option value="+351">🇵🇹 Portugal (+351)</option>
                    <option value="+357">🇨🇾 Cyprus (+357)</option>
                    <option value="+359">🇧🇬 Bulgaria (+359)</option>
                    <option value="+380">🇺🇦 Ukraine (+380)</option>
                    <option value="+381">🇷🇸 Serbia (+381)</option>
                    <option value="+382">🇲🇪 Montenegro (+382)</option>
                    <option value="+383">�� Kosovo (+383)</option>
                    <option value="+385">🇭�🇷 Croatia (+385)</option>
                    <option value="+386">🇸🇮 Slovenia (+386)</option>
                    <option value="+387">🇧🇦 Bosnia and Herzegovina (+387)</option>
                    <option value="+389">🇲🇰 North Macedonia (+389)</option>
                    <option value="+370">🇱🇹 Lithuania (+370)</option>
                    <option value="+371">🇱🇻 Latvia (+371)</option>
                    <option value="+372">🇪🇪 Estonia (+372)</option>
                    <option value="+373">🇲🇩 Moldova (+373)</option>
                    <option value="+374">🇦🇲 Armenia (+374)</option>
                    <option value="+375">🇧🇾 Belarus (+375)</option>
                    <option value="+376">🇦🇩 Andorra (+376)</option>
                    <option value="+377">🇲🇨 Monaco (+377)</option>
                    <option value="+378">🇸🇲 San Marino (+378)</option>
                    <option value="+379">�� Vatican City (+379)</option>
                    <option value="+37">🇦🇱 Albania (+37)</option>
                    <option value="+38">🇦🇹 Austria (+38)</option>
                    <option value="+39">🇧🇪 Belgium (+39)</option>
                    <option value="+40">🇧🇦 Bosnia and Herzegovina (+40)</option>
                    <option value="+41">🇨🇿 Czech Republic (+41)</option>
                    <option value="+42">🇭🇺 Hungary (+42)</option>
                    <option value="+43">🇮🇸 Iceland (+43)</option>
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
