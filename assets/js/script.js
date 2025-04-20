$(document).ready(function() {
    // Country selection
    $('.country-card').click(function() {
        $('.country-card').removeClass('selected');
        $(this).addClass('selected');
        $('#selectedCountry').val($(this).data('country'));
    });

    // Budget selection
    $('.budget-option').click(function() {
        $('.budget-option').removeClass('selected');
        $(this).addClass('selected');
        $('#selectedBudget').val($(this).data('budget'));
        $(this).find('input[type="radio"]').prop('checked', true);
    });

    // Form validation
    $('#personalForm').on('submit', function(e) {
        let valid = true;
        
        // Validate name
        if ($('#name').val().trim() === '') {
            $('#nameError').text('Please enter your name');
            valid = false;
        } else {
            $('#nameError').text('');
        }
        
        // Validate email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test($('#email').val().trim())) {
            $('#emailError').text('Please enter a valid email address');
            valid = false;
        } else {
            $('#emailError').text('');
        }
        
        // Validate mobile
        const mobileRegex = /^\d{10}$/;
        if (!mobileRegex.test($('#mobile').val().trim())) {
            $('#mobileError').text('Please enter a valid 10-digit mobile number');
            valid = false;
        } else {
            $('#mobileError').text('');
        }
        
        // Validate education
        if ($('#education').val() === null || $('#education').val() === '') {
            $('#educationError').text('Please select your education level');
            valid = false;
        } else {
            $('#educationError').text('');
        }
        
        // Validate location
        if ($('#location').val().trim() === '') {
            $('#locationError').text('Please enter your location');
            valid = false;
        } else {
            $('#locationError').text('');
        }
        
        // Validate reCAPTCHA
        if (typeof grecaptcha !== 'undefined' && $('.g-recaptcha').length > 0) {
            const recaptchaResponse = grecaptcha.getResponse();
            if (recaptchaResponse.length === 0) {
                $('#recaptchaError').text('Please verify that you are not a robot');
                valid = false;
            } else {
                $('#recaptchaError').text('');
            }
        }
        
        if (!valid) {
            e.preventDefault();
        }
    });
});
