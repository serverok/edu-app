<?php
session_start();
// Reset session on start
$_SESSION = array();
include 'includes/header.php';
?>

<div class="form-container">
    <div class="progress-container">
        <div class="progress-steps">
            <div class="step active">1</div>
            <div class="step">2</div>
            <div class="step">3</div>
            <div class="active-progress" style="width: 0%"></div>
        </div>
    </div>

    <h2 class="step-heading">Choose your dream <br>
    destinations to work as <br>
    a Doctor </h2>
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
                    <img src="assets/icons/uk.svg" alt="UK" class="country-icon">
                    <h4>UK</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Germany">
                    <img src="assets/icons/germany.svg" alt="Germany" class="country-icon">
                    <h4>Germany</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="USA">
                    <img src="assets/icons/usa.svg" alt="USA" class="country-icon">
                    <h4>USA</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="UAE">
                    <img src="assets/icons/uae.svg" alt="UAE" class="country-icon">
                    <h4>UAE</h4>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="country-card" data-country="Other">
                    <img src="assets/icons/other.svg" alt="Other" class="country-icon">
                    <h4>Other</h4>
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
    // Country selection
    $('.country-card').click(function() {
        $('.country-card').removeClass('selected');
        $(this).addClass('selected');
        $('#selectedCountry').val($(this).data('country'));
        $('#nextBtn').prop('disabled', false);
    });
    
    // Set progress bar width
    $('.active-progress').css('width', '0%');
});
</script>

<?php include 'includes/footer.php'; ?>
