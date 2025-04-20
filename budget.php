<?php
session_start();

// Check if coming from country selection
if (!isset($_POST['selectedCountry']) && !isset($_SESSION['country'])) {
    header("Location: index.php");
    exit;
}

// Store country in session
if (isset($_POST['selectedCountry'])) {
    $_SESSION['country'] = $_POST['selectedCountry'];
}

include 'includes/header.php';

// Define budget ranges based on country
$budgetRanges = [];

$asianCountries = ['India', 'Russia', 'Uzbekistan'];
$easternEuropeCountries = ['Georgia', 'Azerbaijan'];
$europeanUnionCountries = ['Bulgaria', 'Romania'];

if (in_array($_SESSION['country'], $asianCountries)) {
    $budgetRanges = [
        ['range' => '₹1-3 Lakhs/year', 'description' => 'Asian countries', 'examples' => 'Such as Russia, Uzbekistan, etc.'],
        ['range' => '₹4-6 Lakhs/year', 'description' => 'Eastern Europe countries', 'examples' => 'Such as Georgia, Azerbaijan, etc.'],
        ['range' => 'Above ₹6 Lakhs/year', 'description' => 'European Union', 'examples' => 'Such as Bulgaria, Romania, etc.']
    ];
} elseif (in_array($_SESSION['country'], $easternEuropeCountries)) {
    $budgetRanges = [
        ['range' => '₹4-6 Lakhs/year', 'description' => 'Eastern Europe countries', 'examples' => 'Such as Georgia, Azerbaijan, etc.'],
        ['range' => 'Above ₹6 Lakhs/year', 'description' => 'European Union', 'examples' => 'Such as Bulgaria, Romania, etc.'],
        ['range' => '₹1-3 Lakhs/year', 'description' => 'Asian countries', 'examples' => 'Such as Russia, Uzbekistan, etc.']
    ];
} else {
    $budgetRanges = [
        ['range' => 'Above ₹6 Lakhs/year', 'description' => 'European Union', 'examples' => 'Such as Bulgaria, Romania, etc.'],
        ['range' => '₹4-6 Lakhs/year', 'description' => 'Eastern Europe countries', 'examples' => 'Such as Georgia, Azerbaijan, etc.'],
        ['range' => '₹1-3 Lakhs/year', 'description' => 'Asian countries', 'examples' => 'Such as Russia, Uzbekistan, etc.']
    ];
}
?>

<div class="form-container">
    <div class="progress-container">
        <div class="progress-steps">
            <div class="step completed">1</div>
            <div class="step active">2</div>
            <div class="step">3</div>
            <div class="active-progress" style="width: 55%"></div>
        </div>
    </div>

    <h2 class="step-heading">Choose your affordable <span class="highlight">budget</span> for a year</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger mb-4">
            <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="form.php" method="post">
        <?php foreach($budgetRanges as $index => $budget): ?>
        <div class="budget-option" data-budget="<?php echo $budget['range']; ?>">
            <div class="row">
                <div class="col-10">
                    <h4><?php echo $budget['range']; ?></h4>
                    <p class="mb-0"><?php echo $budget['description']; ?></p>
                    <small class="text-muted"><?php echo $budget['examples']; ?></small>
                </div>
                <div class="col-2 d-flex align-items-center justify-content-end">
                    <input type="radio" name="selectedBudget" value="<?php echo $budget['range']; ?>" style="display: none;" id="budget<?php echo $index; ?>">
                    <div class="radio-custom"></div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>

        <input type="hidden" name="country" value="<?php echo $_SESSION['country']; ?>">
        
        <div class="text-center mt-4">
            <div class="row">
                <div class="col-6">
                    <a href="index.php" class="btn btn-outline-secondary w-100">Back</a>
                </div>
                <div class="col-6">
                    <button type="submit" class="action-btn w-100" id="nextBtn" disabled>Next</button>
                </div>
            </div>
            <div class="mt-3 text-center">
                <small>2/3</small>
            </div>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Enable next button when a budget is selected
    $('.budget-option').click(function() {
        $('#nextBtn').prop('disabled', false);
    });
    
    // Set progress bar width
    $('.active-progress').css('width', '33.33%');
});
</script>

<?php include 'includes/footer.php'; ?>
