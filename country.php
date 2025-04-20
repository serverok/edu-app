<?php
session_start();
include 'includes/header.php';
?>

<div class="form-container">
    <div class="progress-container">
        <div class="progress-steps">
            <div class="step active">1</div>
            <div class="step">2</div>
            <div class="step">3</div>
            <div class="step">4</div>
            <div class="active-progress" style="width: 0%"></div>
        </div>
    </div>

    <h2 class="step-heading">Choose your dream destination</h2>
    <p class="step-subheading">Select a country to continue</p>

    <form action="budget.php" method="post">
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="India">
                    <img src="assets/icons/india.svg" alt="India" class="country-icon">
                    <h4>India</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Russia">
                    <img src="assets/icons/russia.svg" alt="Russia" class="country-icon">
                    <h4>Russia</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Uzbekistan">
                    <img src="assets/icons/uzbekistan.svg" alt="Uzbekistan" class="country-icon">
                    <h4>Uzbekistan</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Georgia">
                    <img src="assets/icons/georgia.svg" alt="Georgia" class="country-icon">
                    <h4>Georgia</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Romania">
                    <img src="assets/icons/romania.svg" alt="Romania" class="country-icon">
                    <h4>Romania</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Bulgaria">
                    <img src="assets/icons/bulgaria.svg" alt="Bulgaria" class="country-icon">
                    <h4>Bulgaria</h4>
                </div>
            </div>
        </div>

        <input type="hidden" name="selectedCountry" id="selectedCountry" value="">
        
        <div class="text-center mt-4">
            <button type="submit" class="action-btn" id="nextBtn" disabled>Next</button>
        </div>
    </form>
</div>

<script>
$(document).ready(function() {
    // Enable next button when a country is selected
    $('.country-card').click(function() {
        $('#nextBtn').prop('disabled', false);
    });
    
    // Set progress bar width
    $('.active-progress').css('width', '0%');
});
</script>

<?php include 'includes/footer.php'; ?>
