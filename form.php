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
                    <option value="+383">🇽🇰 Kosovo (+383)</option>
                    <option value="+385">🇭🇷 Croatia (+385)</option>
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
                    <option value="+379">🇻🇦 Vatican City (+379)</option>
                    <option value="+37">🇦🇱 Albania (+355)</option>
                    <option value="+43">🇦🇹 Austria (+43)</option>
                    <option value="+32">🇧🇪 Belgium (+32)</option>
                    <option value="+420">🇨🇿 Czech Republic (+420)</option>
                    <option value="+36">🇭🇺 Hungary (+36)</option>
                    <option value="+354">🇮🇸 Iceland (+354)</option>
                    <option value="+966">🇸🇦 Saudi Arabia (+966)</option>
                    <option value="+971">🇦🇪 United Arab Emirates (+971)</option>
                    <option value="+972">🇮🇱 Israel (+972)</option>
                    <option value="+973">🇧🇭 Bahrain (+973)</option>
                    <option value="+974">🇶🇦 Qatar (+974)</option>
                    <option value="+98">🇮🇷 Iran (+98)</option>
                    <option value="+964">🇮🇶 Iraq (+964)</option>
                    <option value="+962">🇯🇴 Jordan (+962)</option>
                    <option value="+963">🇸🇾 Syria (+963)</option>
                    <option value="+965">🇰🇼 Kuwait (+965)</option>
                    <option value="+967">🇾🇪 Yemen (+967)</option>
                    <option value="+968">🇴🇲 Oman (+968)</option>
                    <option value="+970">🇵🇸 Palestine (+970)</option>
                    <option value="+975">🇧🇹 Bhutan (+975)</option>
                    <option value="+977">🇳🇵 Nepal (+977)</option>
                    <option value="+976">🇲🇳 Mongolia (+976)</option>
                    <option value="+977">🇳🇵 Nepal (+977)</option>
                    <option value="+880">🇧🇩 Bangladesh (+880)</option>
                    <option value="+886">🇹🇼 Taiwan (+886)</option>
                    <option value="+84">🇻🇳 Vietnam (+84)</option>
                    <option value="+852">🇭🇰 Hong Kong (+852)</option>
                    <option value="+853">🇲🇴 Macao (+853)</option>
                    <option value="+855">🇰🇭 Cambodia (+855)</option>
                    <option value="+856">🇱🇦 Laos (+856)</option>
                    <option value="+82">🇰🇷 South Korea (+82)</option>
                    <option value="+880">🇧🇩 Bangladesh (+880)</option>
                    <option value="+90">🇹🇷 Turkey (+90)</option>
                    <option value="+92">🇵🇰 Pakistan (+92)</option>
                    <option value="+93">🇦🇫 Afghanistan (+93)</option>
                    <option value="+94">🇱🇰 Sri Lanka (+94)</option>
                    <option value="+95">🇲🇲 Myanmar (+95)</option>
                    <option value="+20">🇪🇬 Egypt (+20)</option>
                    <option value="+212">🇲🇦 Morocco (+212)</option>
                    <option value="+213">🇩🇿 Algeria (+213)</option>
                    <option value="+216">🇹🇳 Tunisia (+216)</option>
                    <option value="+218">🇱🇾 Libya (+218)</option>
                    <option value="+220">🇬🇲 Gambia (+220)</option>
                    <option value="+221">🇸🇳 Senegal (+221)</option>
                    <option value="+222">🇲🇷 Mauritania (+222)</option>
                    <option value="+223">🇲🇱 Mali (+223)</option>
                    <option value="+224">🇬🇳 Guinea (+224)</option>
                    <option value="+225">🇨🇮 Ivory Coast (+225)</option>
                    <option value="+226">🇧🇫 Burkina Faso (+226)</option>
                    <option value="+227">🇳🇪 Niger (+227)</option>
                    <option value="+228">🇹🇬 Togo (+228)</option>
                    <option value="+229">🇧🇯 Benin (+229)</option>
                    <option value="+230">🇲🇺 Mauritius (+230)</option>
                    <option value="+231">🇱🇷 Liberia (+231)</option>
                    <option value="+232">🇸🇱 Sierra Leone (+232)</option>
                    <option value="+233">🇬🇭 Ghana (+233)</option>
                    <option value="+234">🇳🇬 Nigeria (+234)</option>
                    <option value="+235">🇹🇩 Chad (+235)</option>
                    <option value="+236">🇨🇫 Central African Republic (+236)</option>
                    <option value="+237">🇨🇲 Cameroon (+237)</option>
                    <option value="+238">🇨🇻 Cape Verde (+238)</option>
                    <option value="+239">🇸🇹 São Tomé and Príncipe (+239)</option>
                    <option value="+240">🇬🇶 Equatorial Guinea (+240)</option>
                    <option value="+241">🇬🇦 Gabon (+241)</option>
                    <option value="+242">🇨🇬 Congo (+242)</option>
                    <option value="+243">🇨🇩 Democratic Republic of the Congo (+243)</option>
                    <option value="+244">🇦🇴 Angola (+244)</option>
                    <option value="+245">🇬🇼 Guinea-Bissau (+245)</option>
                    <option value="+246">🇮🇴 British Indian Ocean Territory (+246)</option>
                    <option value="+248">🇸🇨 Seychelles (+248)</option>
                    <option value="+249">🇸🇩 Sudan (+249)</option>
                    <option value="+250">🇷🇼 Rwanda (+250)</option>
                    <option value="+251">🇪🇹 Ethiopia (+251)</option>
                    <option value="+252">🇸🇴 Somalia (+252)</option>
                    <option value="+253">🇩🇯 Djibouti (+253)</option>
                    <option value="+254">🇰🇪 Kenya (+254)</option>
                    <option value="+255">🇹🇿 Tanzania (+255)</option>
                    <option value="+256">🇺🇬 Uganda (+256)</option>
                    <option value="+257">🇧🇮 Burundi (+257)</option>
                    <option value="+258">🇲🇿 Mozambique (+258)</option>
                    <option value="+260">🇿🇲 Zambia (+260)</option>
                    <option value="+261">🇲🇬 Madagascar (+261)</option>
                    <option value="+262">🇾🇹 Mayotte (+262)</option>
                    <option value="+263">🇿🇼 Zimbabwe (+263)</option>
                    <option value="+264">🇳🇦 Namibia (+264)</option>
                    <option value="+265">🇲🇼 Malawi (+265)</option>
                    <option value="+266">🇱🇸 Lesotho (+266)</option>
                    <option value="+267">🇧🇼 Botswana (+267)</option>
                    <option value="+268">🇸🇿 Eswatini (+268)</option>
                    <option value="+269">🇰🇲 Comoros (+269)</option>
                    <option value="+27">🇿🇦 South Africa (+27)</option>
                    <option value="+290">🇸🇭 Saint Helena (+290)</option>
                    <option value="+291">🇪🇷 Eritrea (+291)</option>
                    <option value="+297">🇦🇼 Aruba (+297)</option>
                    <option value="+298">🇫🇴 Faroe Islands (+298)</option>
                    <option value="+299">🇬🇱 Greenland (+299)</option>
                    <option value="+30">🇬🇷 Greece (+30)</option>
                    <option value="+350">🇬🇮 Gibraltar (+350)</option>
                    <option value="+355">🇦🇱 Albania (+355)</option>
                    <option value="+356">🇲🇹 Malta (+356)</option>
                    <option value="+357">🇨🇾 Cyprus (+357)</option>
                    <option value="+358">🇫🇮 Finland (+358)</option>
                    <option value="+359">🇧🇬 Bulgaria (+359)</option>
                    <option value="+370">🇱🇹 Lithuania (+370)</option>
                    <option value="+371">🇱🇻 Latvia (+371)</option>
                    <option value="+372">🇪🇪 Estonia (+372)</option>
                    <option value="+373">🇲🇩 Moldova (+373)</option>
                    <option value="+374">🇦🇲 Armenia (+374)</option>
                    <option value="+375">🇧🇾 Belarus (+375)</option>
                    <option value="+376">🇦🇩 Andorra (+376)</option>
                    <option value="+377">🇲🇨 Monaco (+377)</option>
                    <option value="+378">🇸🇲 San Marino (+378)</option>
                    <option value="+379">🇻🇦 Vatican City (+379)</option>
                    <option value="+380">🇺🇦 Ukraine (+380)</option>
                    <option value="+381">🇷🇸 Serbia (+381)</option>
                    <option value="+382">🇲🇪 Montenegro (+382)</option>
                    <option value="+383">🇽🇰 Kosovo (+383)</option>
                    <option value="+385">🇭🇷 Croatia (+385)</option>
                    <option value="+386">🇸🇮 Slovenia (+386)</option>
                    <option value="+387">🇧🇦 Bosnia and Herzegovina (+387)</option>
                    <option value="+389">🇲🇰 North Macedonia (+389)</option>
                    <option value="+420">🇨🇿 Czech Republic (+420)</option>
                    <option value="+421">🇸🇰 Slovakia (+421)</option>
                    <option value="+423">🇱🇮 Liechtenstein (+423)</option>
                    <option value="+500">🇫🇰 Falkland Islands (+500)</option>
                    <option value="+501">🇧🇿 Belize (+501)</option>
                    <option value="+502">🇬🇹 Guatemala (+502)</option>
                    <option value="+503">🇸🇻 El Salvador (+503)</option>
                    <option value="+504">🇭🇳 Honduras (+504)</option>
                    <option value="+505">🇳🇮 Nicaragua (+505)</option>
                    <option value="+506">🇨🇷 Costa Rica (+506)</option>
                    <option value="+507">🇵🇦 Panama (+507)</option>
                    <option value="+508">🇵🇲 Saint Pierre and Miquelon (+508)</option>
                    <option value="+509">🇭🇹 Haiti (+509)</option>
                    <option value="+590">🇬🇵 Guadeloupe (+590)</option>
                    <option value="+591">🇧🇴 Bolivia (+591)</option>
                    <option value="+592">🇬🇾 Guyana (+592)</option>
                    <option value="+593">🇪🇨 Ecuador (+593)</option>
                    <option value="+594">🇬🇫 French Guiana (+594)</option>
                    <option value="+595">🇵🇾 Paraguay (+595)</option>
                    <option value="+596">🇲🇶 Martinique (+596)</option>
                    <option value="+597">🇸🇷 Suriname (+597)</option>
                    <option value="+598">🇺🇾 Uruguay (+598)</option>
                    <option value="+599">🇨🇼 Curaçao (+599)</option>
                    <option value="+670">🇹🇱 Timor-Leste (+670)</option>
                    <option value="+672">🇦🇶 Antarctica (+672)</option>
                    <option value="+673">🇧🇳 Brunei (+673)</option>
                    <option value="+674">🇳🇷 Nauru (+674)</option>
                    <option value="+675">🇵🇬 Papua New Guinea (+675)</option>
                    <option value="+676">🇹🇴 Tonga (+676)</option>
                    <option value="+677">🇸🇧 Solomon Islands (+677)</option>
                    <option value="+678">🇻🇺 Vanuatu (+678)</option>
                    <option value="+679">🇫🇯 Fiji (+679)</option>
                    <option value="+680">🇵🇼 Palau (+680)</option>
                    <option value="+681">🇼🇫 Wallis and Futuna (+681)</option>
                    <option value="+682">🇨🇰 Cook Islands (+682)</option>
                    <option value="+683">🇳🇺 Niue (+683)</option>
                    <option value="+685">🇼🇸 Samoa (+685)</option>
                    <option value="+686">🇰🇮 Kiribati (+686)</option>
                    <option value="+687">🇳🇨 New Caledonia (+687)</option>
                    <option value="+688">🇹🇻 Tuvalu (+688)</option>
                    <option value="+689">🇵🇫 French Polynesia (+689)</option>
                    <option value="+690">🇹🇰 Tokelau (+690)</option>
                    <option value="+691">🇫🇲 Micronesia (+691)</option>
                    <option value="+692">🇲🇭 Marshall Islands (+692)</option>
                    <option value="+850">🇰🇵 North Korea (+850)</option>
                    <option value="+852">🇭🇰 Hong Kong (+852)</option>
                    <option value="+853">🇲🇴 Macao (+853)</option>
                    <option value="+855">🇰🇭 Cambodia (+855)</option>
                    <option value="+856">🇱🇦 Laos (+856)</option>
                    <option value="+880">🇧🇩 Bangladesh (+880)</option>
                    <option value="+886">🇹🇼 Taiwan (+886)</option>
                    <option value="+960">🇲🇻 Maldives (+960)</option>
                    <option value="+961">🇱🇧 Lebanon (+961)</option>
                    <option value="+962">🇯🇴 Jordan (+962)</option>
                    <option value="+963">🇸🇾 Syria (+963)</option>
                    <option value="+964">🇮🇶 Iraq (+964)</option>
                    <option value="+965">🇰🇼 Kuwait (+965)</option>
                    <option value="+966">🇸🇦 Saudi Arabia (+966)</option>
                    <option value="+967">🇾🇪 Yemen (+967)</option>
                    <option value="+968">🇴🇲 Oman (+968)</option>
                    <option value="+970">🇵🇸 Palestine (+970)</option>
                    <option value="+971">🇦🇪 United Arab Emirates (+971)</option>
                    <option value="+972">🇮🇱 Israel (+972)</option>
                    <option value="+973">🇧🇭 Bahrain (+973)</option>
                    <option value="+974">🇶🇦 Qatar (+974)</option>
                    <option value="+975">🇧🇹 Bhutan (+975)</option>
                    <option value="+976">🇲🇳 Mongolia (+976)</option>
                    <option value="+977">🇳🇵 Nepal (+977)</option>
                    <option value="+992">🇹🇯 Tajikistan (+992)</option>
                    <option value="+993">🇹🇲 Turkmenistan (+993)</option>
                    <option value="+994">🇦🇿 Azerbaijan (+994)</option>
                    <option value="+995">🇬🇪 Georgia (+995)</option>
                    <option value="+996">🇰🇬 Kyrgyzstan (+996)</option>
                    <option value="+998">🇺🇿 Uzbekistan (+998)</option>
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
