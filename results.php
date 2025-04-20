<?php
session_start();

// Check if user data exists in session
if (!isset($_SESSION['user_data']) || !isset($_SESSION['country']) || !isset($_SESSION['budget'])) {
    header("Location: index.php");
    exit;
}

include 'includes/header.php';

// Get user selection information
$country = $_SESSION['country'];
$budget = $_SESSION['budget'];
$name = $_SESSION['user_data']['name'];

// Define university data based on country and budget
$universities = [];

// Asian countries with lower budget
if ($country == 'India' || $country == 'Russia' || $country == 'Uzbekistan') {
    if (strpos($budget, '1-3') !== false) {
        $universities = [
            [
                'name' => 'Tashkent Medical Academy',
                'country' => 'Uzbekistan',
                'flag' => 'uzbekistan.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Tashkent+Medical+Academy',
                'ranking' => '4662',
                'indian_students' => '300',
                'course_duration' => '6 years',
                'course_fee' => '₹2.97 Lakhs/year',
                'accommodation' => '5000 /month',
                'food' => '₹8000 /month'
            ],
            [
                'name' => 'Andijan State Medical Institute',
                'country' => 'Uzbekistan',
                'flag' => 'uzbekistan.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Andijan+State+Medical+Institute',
                'ranking' => '5044',
                'indian_students' => '500',
                'course_duration' => '6 years',
                'course_fee' => '₹2.97 Lakhs/year',
                'accommodation' => '4250 /month',
                'food' => '₹10200 /month'
            ],
            [
                'name' => 'Samarkand State Medical University',
                'country' => 'Uzbekistan',
                'flag' => 'uzbekistan.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Samarkand+State+Medical+University',
                'ranking' => '4918',
                'indian_students' => '400',
                'course_duration' => '6 years',
                'course_fee' => '₹2.5 Lakhs/year',
                'accommodation' => '4500 /month',
                'food' => '₹9000 /month'
            ]
        ];
    }
}

// Eastern Europe countries with medium budget
if ($country == 'Georgia') {
    if (strpos($budget, '4-6') !== false) {
        $universities = [
            [
                'name' => 'Akaki Tsereteli State University',
                'country' => 'Georgia',
                'flag' => 'georgia.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Akaki+Tsereteli+State+University',
                'ranking' => '7734',
                'indian_students' => '400',
                'course_duration' => '6 years',
                'course_fee' => '₹3.4 Lakhs/year',
                'accommodation' => '14000 /month',
                'food' => '₹12000 /month'
            ],
            [
                'name' => 'Tbilisi State Medical University',
                'country' => 'Georgia',
                'flag' => 'georgia.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Tbilisi+State+Medical+University',
                'ranking' => '6820',
                'indian_students' => '600',
                'course_duration' => '6 years',
                'course_fee' => '₹4.2 Lakhs/year',
                'accommodation' => '15000 /month',
                'food' => '₹13000 /month'
            ]
        ];
    }
}

// European Union countries with higher budget
if ($country == 'Romania' || $country == 'Bulgaria') {
    if (strpos($budget, 'Above') !== false) {
        $universities = [
            [
                'name' => 'Carol Davila University of Medicine',
                'country' => 'Romania',
                'flag' => 'romania.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Carol+Davila+University',
                'ranking' => '3500',
                'indian_students' => '200',
                'course_duration' => '6 years',
                'course_fee' => '₹6.5 Lakhs/year',
                'accommodation' => '18000 /month',
                'food' => '₹15000 /month'
            ],
            [
                'name' => 'Medical University of Sofia',
                'country' => 'Bulgaria',
                'flag' => 'bulgaria.svg',
                'img' => 'https://via.placeholder.com/600x350?text=Medical+University+of+Sofia',
                'ranking' => '3250',
                'indian_students' => '250',
                'course_duration' => '6 years',
                'course_fee' => '₹7.2 Lakhs/year',
                'accommodation' => '20000 /month',
                'food' => '₹16000 /month'
            ]
        ];
    }
}

// If no universities match the criteria, show general options
if (empty($universities)) {
    $universities = [
        [
            'name' => 'Tashkent Medical Academy',
            'country' => 'Uzbekistan',
            'flag' => 'uzbekistan.svg',
            'img' => 'https://via.placeholder.com/600x350?text=Tashkent+Medical+Academy',
            'ranking' => '4662',
            'indian_students' => '300',
            'course_duration' => '6 years',
            'course_fee' => '₹2.97 Lakhs/year',
            'accommodation' => '5000 /month',
            'food' => '₹8000 /month'
        ],
        [
            'name' => 'Akaki Tsereteli State University',
            'country' => 'Georgia',
            'flag' => 'georgia.svg',
            'img' => 'https://via.placeholder.com/600x350?text=Akaki+Tsereteli+State+University',
            'ranking' => '7734',
            'indian_students' => '400',
            'course_duration' => '6 years',
            'course_fee' => '₹3.4 Lakhs/year',
            'accommodation' => '14000 /month',
            'food' => '₹12000 /month'
        ],
        [
            'name' => 'Medical University of Sofia',
            'country' => 'Bulgaria',
            'flag' => 'bulgaria.svg',
            'img' => 'https://via.placeholder.com/600x350?text=Medical+University+of+Sofia',
            'ranking' => '3250',
            'indian_students' => '250',
            'course_duration' => '6 years',
            'course_fee' => '₹7.2 Lakhs/year',
            'accommodation' => '20000 /month',
            'food' => '₹16000 /month'
        ]
    ];
}
?>

<div class="form-container">
    <div class="progress-container">
        <div class="progress-steps">
            <div class="step completed">1</div>
            <div class="step completed">2</div>
            <div class="step completed">3</div>
            <div class="step active">4</div>
            <div class="active-progress" style="width: 100%"></div>
        </div>
    </div>

    <h2 class="step-heading">Here's your</h2>
    <h2 class="step-heading">Top recommendations</h2>
    <p class="step-subheading">These universities are listed in WHO, accredited by ECFMG, and follows every norms of NMC Guidelines. So, you are able to work in UK</p>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success mb-4">
            <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['warning'])): ?>
        <div class="alert alert-warning mb-4">
            <?php echo $_SESSION['warning']; unset($_SESSION['warning']); ?>
        </div>
    <?php endif; ?>

    <div class="row">
        <?php foreach($universities as $university): ?>
        <div class="col-md-4 mb-4">
            <div class="university-card">
                <div class="university-image" style="background-color: #f0f0f0; display: flex; align-items: center; justify-content: center;">
                    <h3><?php echo $university['name']; ?></h3>
                </div>
                <div class="university-details">
                    <h5 class="university-name"><?php echo $university['name']; ?></h5>
                    <div class="university-country">
                        <img src="assets/icons/<?php echo $university['flag']; ?>" alt="<?php echo $university['country']; ?>">
                        <?php echo $university['country']; ?>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="stat-label">Indian Students:</div>
                            <div class="stat-value"><?php echo $university['indian_students']; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="stat-label">Course Duration:</div>
                            <div class="stat-value"><?php echo $university['course_duration']; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="stat-label">Ranking:</div>
                            <div class="stat-value"><?php echo $university['ranking']; ?></div>
                        </div>
                    </div>
                    
                    <div class="row mb-3">
                        <div class="col-4">
                            <div class="stat-label">Course Fee:</div>
                            <div class="stat-value"><?php echo $university['course_fee']; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="stat-label">Accommodation:</div>
                            <div class="stat-value"><?php echo $university['accommodation']; ?></div>
                        </div>
                        <div class="col-4">
                            <div class="stat-label">Food:</div>
                            <div class="stat-value"><?php echo $university['food']; ?></div>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="#" class="btn btn-outline-success">Get More Details</a>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
    
    <div class="text-center mt-4">
        <a href="index.php" class="btn btn-outline-secondary">Start New Search</a>
    </div>
</div>

<?php include 'includes/footer.php'; ?>
