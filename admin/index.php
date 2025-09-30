<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header('Location: index2.php');
    exit;
}

require_once 'db_conn.php';

// Get the user ID from the session
$user_id = $_SESSION['user_id'];

// Determine whether the user is a student or a regular user
// Check the 'students' table first
$stmt = $conn->prepare("SELECT full_name, email FROM students WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    // The user is a student
    $user = $result->fetch_assoc();
    $_SESSION['user_type'] = 'student';
    $_SESSION['user_name'] = $user['full_name'];
    $_SESSION['user_email'] = $user['email'];
} else {
    // If not found in 'students', check the 'users' table
    $stmt = $conn->prepare("SELECT firstname, lastname FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // The user is a regular user
        $user = $result->fetch_assoc();
        $_SESSION['user_type'] = 'regular_user';
        $_SESSION['user_name'] = $user['firstname'] . ' ' . $user['lastname'];
    } else {
        // If user is not found in either table, log them out
        session_destroy();
        header('Location: index2.php');
        exit;
    }
}
// Database queries for the charts
// Course vs Career relationship data
$courseRelationQuery = "
    SELECT 
        b.batch_name,
        b.year_graduated,
        COUNT(CASE WHEN f.is_related = 'yes' THEN 1 END) as related,
        COUNT(CASE WHEN f.is_related = 'no' THEN 1 END) as unrelated,
        COUNT(*) as total
    FROM students s
    JOIN batches b ON s.batch_id = b.id
    LEFT JOIN first_job_related_to_course f ON s.id = f.student_id
    GROUP BY b.id, b.batch_name, b.year_graduated
    ORDER BY b.year_graduated DESC
    LIMIT 4";

$courseRelationResult = $conn->query($courseRelationQuery);
$courseRelationData = ['related' => [], 'unrelated' => []];
$batchLabels = [];

while ($row = $courseRelationResult->fetch_assoc()) {
    $total = $row['total'] > 0 ? $row['total'] : 1;
    $relatedPercentage = round(($row['related'] / $total) * 100, 1);
    $unrelatedPercentage = round(($row['unrelated'] / $total) * 100, 1);
    
    $courseRelationData['related'][] = $relatedPercentage;
    $courseRelationData['unrelated'][] = $unrelatedPercentage;
    $batchLabels[] = "Batch " . $row['year_graduated'];
}

// Employment Status data
$employmentQuery = "
    SELECT 
        pes.employment_status_current,
        COUNT(*) as count,
        COUNT(*) * 100.0 / (SELECT COUNT(*) FROM present_employment_status) as percentage
    FROM present_employment_status pes
    GROUP BY pes.employment_status_current";

$employmentResult = $conn->query($employmentQuery);
$employmentData = [];

while ($row = $employmentResult->fetch_assoc()) {
    $employmentData[] = [
        'value' => round($row['percentage'], 1),
        'name' => $row['employment_status_current']
    ];
}

// Get total students tracked
$totalStudentsQuery = "SELECT COUNT(*) as total FROM students";
$totalStudentsResult = $conn->query($totalStudentsQuery);
$totalStudents = $totalStudentsResult->fetch_assoc()['total'];

// Get recent survey submissions
$recentSubmissionsQuery = "
    SELECT COUNT(DISTINCT student_id) as total 
    FROM (
        SELECT student_id FROM first_job_related_to_course
        UNION
        SELECT student_id FROM present_employment_status
    ) as submissions";
$recentSubmissionsResult = $conn->query($recentSubmissionsQuery);
$recentSubmissions = $recentSubmissionsResult->fetch_assoc()['total'];

// Get employment rate
$employmentQuery = "
    SELECT COUNT(*) as employed 
    FROM present_employment_status pes
    JOIN students s ON pes.student_id = s.id
    WHERE pes.employment_status_current != 'Unemployed'";
$employmentResult = $conn->query($employmentQuery);
$employedCount = $employmentResult->fetch_assoc()['employed'];
$employmentRate = $recentSubmissions > 0 ? round(($employedCount / $recentSubmissions) * 100) : 0;

// Convert PHP data to JSON for JavaScript use
$chartData = [
    'courseRelation' => [
        'labels' => $batchLabels,
        'related' => $courseRelationData['related'],
        'unrelated' => $courseRelationData['unrelated']
    ],
    'employmentStatus' => $employmentData
];

// Get all batches for the dropdown
$batchesQuery = "SELECT id, batch_name, year_graduated FROM batches WHERE is_archived = 0 ORDER BY year_graduated DESC";
$batchesResult = $conn->query($batchesQuery);
$batches = [];
while ($row = $batchesResult->fetch_assoc()) {
    $batches[] = $row;
}

// Get employment sector data
$sectorQuery = "
    SELECT 
        COUNT(CASE WHEN pow.local_place IS NOT NULL AND pow.local_place != '' THEN 1 END) as government,
        COUNT(CASE WHEN pow.abroad_place IS NOT NULL AND pow.abroad_place != '' THEN 1 END) as non_government,
        COUNT(*) as total
    FROM present_employment_status pes
    JOIN students s ON pes.student_id = s.id
    LEFT JOIN place_of_work pow ON pes.student_id = pow.student_id
    WHERE pes.employment_status_current != 'Unemployed'";
$sectorResult = $conn->query($sectorQuery);
$sectorData = $sectorResult->fetch_assoc();
$governmentPercentage = $sectorData['total'] > 0 ? round(($sectorData['government'] / $sectorData['total']) * 100) : 0;
$nonGovernmentPercentage = $sectorData['total'] > 0 ? round(($sectorData['non_government'] / $sectorData['total']) * 100) : 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Dashboard - SEAITGraduateTracer</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">


</head>

<body>

    <?php include('inc/header.php'); ?>
    <?php include('inc/sidebar.php'); ?>

    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">
                <div class="col-lg-8">
                    <div class="row">
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card" id="totalStudentsCard">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Total Students</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark p-0" type="button" id="studentsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="studentsDropdown">
                                                <li><h6 class="dropdown-header">Select Batch</h6></li>
                                                <li><a class="dropdown-item" href="#" data-batch-id="all">All Batches</a></li>
                                                <?php foreach ($batches as $batch): ?>
                                                <li><a class="dropdown-item" href="#" data-batch-id="<?php echo $batch['id']; ?>"><?php echo $batch['batch_name']; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-team-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <i class="bi bi-arrow-repeat spin loading-spinner"></i>
                                            <h6 id="totalStudentsCount"><?php echo number_format($totalStudents); ?></h6>
                                            <span class="text-muted small pt-2">Alumni</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card" id="responseRateCard">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Survey Response Rate</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark p-0" type="button" id="surveyDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="surveyDropdown">
                                                <li><h6 class="dropdown-header">Select Batch</h6></li>
                                                <li><a class="dropdown-item" href="#" data-batch-id="all">All Batches</a></li>
                                                <?php foreach ($batches as $batch): ?>
                                                <li><a class="dropdown-item" href="#" data-batch-id="<?php echo $batch['id']; ?>"><?php echo $batch['batch_name']; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-survey-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <i class="bi bi-arrow-repeat spin loading-spinner"></i>
                                            <h6 id="responseRate"><?php 
                                                $responseRate = ($totalStudents > 0) ? round(($recentSubmissions / $totalStudents) * 100) : 0;
                                                echo $responseRate . '%';
                                            ?></h6>
                                            <span class="text-muted small pt-2">Completion Rate</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card customers-card" id="employmentRateCard">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Employment Rate</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark p-0" type="button" id="employmentDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="employmentDropdown">
                                                <li><h6 class="dropdown-header">Select Batch</h6></li>
                                                <li><a class="dropdown-item" href="#" data-batch-id="all">All Batches</a></li>
                                                <?php foreach ($batches as $batch): ?>
                                                <li><a class="dropdown-item" href="#" data-batch-id="<?php echo $batch['id']; ?>"><?php echo $batch['batch_name']; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="ri-briefcase-fill"></i>
                                        </div>
                                        <div class="ps-3">
                                            <i class="bi bi-arrow-repeat spin loading-spinner"></i>
                                            <h6 id="employmentRate"><?php echo $employmentRate; ?>%</h6>
                                            <span class="text-muted small pt-2">Employed Graduates</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-12 col-md-12">
                            <div class="card info-card" id="employmentSectorCard">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h5 class="card-title">Employment Sector</h5>
                                        <div class="dropdown">
                                            <button class="btn btn-link text-dark p-0" type="button" id="sectorDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="sectorDropdown">
                                                <li><h6 class="dropdown-header">Select Batch</h6></li>
                                                <li><a class="dropdown-item" href="#" data-batch-id="all">All Batches</a></li>
                                                <?php foreach ($batches as $batch): ?>
                                                <li><a class="dropdown-item" href="#" data-batch-id="<?php echo $batch['id']; ?>"><?php echo $batch['batch_name']; ?></a></li>
                                                <?php endforeach; ?>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="row employment-sector">
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h6>Government</h6>
                                                <div class="d-flex justify-content-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-white">
                                                        <i class="ri-government-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <i class="bi bi-arrow-repeat spin loading-spinner"></i>
                                                    <h4 id="governmentPercentage"><?php echo $governmentPercentage; ?>%</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="text-center">
                                                <h6>Non-Government</h6>
                                                <div class="d-flex justify-content-center">
                                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white">
                                                        <i class="ri-building-2-fill"></i>
                                                    </div>
                                                </div>
                                                <div class="mt-2">
                                                    <i class="bi bi-arrow-repeat spin loading-spinner"></i>
                                                    <h4 id="nonGovernmentPercentage"><?php echo $nonGovernmentPercentage; ?>%</h4>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent News & Updates</h5>
                            <div class="news">
                                <?php
                                $newsQuery = "SELECT * FROM news ORDER BY created_at DESC LIMIT 3";
                                $newsResult = $conn->query($newsQuery);
                                while ($news = $newsResult->fetch_assoc()) {
                                ?>
                                <div class="post-item clearfix">
                                    <img src="<?php echo $news['image']; ?>" alt="">
                                    <h4><a href="#"><?php echo $news['title']; ?></a></h4>
                                    <p><?php echo substr(strip_tags($news['description']), 0, 100) . '...'; ?></p>
                                </div>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Course vs Career Relationship</h5>
                            <div id="barChart" style="min-height: 400px;" class="echart"></div>
                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const chartData = <?php echo json_encode($chartData); ?>;
                                const barChart = echarts.init(document.querySelector("#barChart"));
                                const barOption = {
                                    title: {
                                        text: 'Course vs Career Relationship by Batch',
                                        left: 'center'
                                    },
                                    tooltip: {
                                        trigger: 'axis',
                                        axisPointer: {
                                            type: 'shadow'
                                        },
                                        formatter: function(params) {
                                            let tooltip = params[0].axisValue + '<br/>';
                                            params.forEach(param => {
                                                tooltip += param.seriesName + ': ' + param.value + '%<br/>';
                                            });
                                            return tooltip;
                                        }
                                    },
                                    legend: {
                                        data: ['Related to Course', 'Unrelated to Course'],
                                        bottom: '0%'
                                    },
                                    grid: {
                                        left: '3%',
                                        right: '4%',
                                        bottom: '10%',
                                        containLabel: true
                                    },
                                    xAxis: {
                                        type: 'category',
                                        data: chartData.courseRelation.labels
                                    },
                                    yAxis: {
                                        type: 'value',
                                        max: 100,
                                        axisLabel: {
                                            formatter: '{value}%'
                                        }
                                    },
                                    series: [{
                                        name: 'Related to Course',
                                        type: 'bar',
                                        stack: 'total',
                                        emphasis: {
                                            focus: 'series'
                                        },
                                        data: chartData.courseRelation.related,
                                        itemStyle: {
                                            color: '#4CAF50'
                                        }
                                    },
                                    {
                                        name: 'Unrelated to Course',
                                        type: 'bar',
                                        stack: 'total',
                                        emphasis: {
                                            focus: 'series'
                                        },
                                        data: chartData.courseRelation.unrelated,
                                        itemStyle: {
                                            color: '#F44336'
                                        }
                                    }]
                                };
                                barChart.setOption(barOption);
                                window.addEventListener('resize', function() {
                                    barChart.resize();
                                });
                            });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Employment Status Distribution</h5>
                            <div id="pieChart" style="min-height: 400px;" class="echart"></div>
                            <script>
                            document.addEventListener("DOMContentLoaded", () => {
                                const chartData = <?php echo json_encode($chartData); ?>;
                                const pieChart = echarts.init(document.querySelector("#pieChart"));
                                const pieOption = {
                                    title: {
                                        text: 'Current Employment Status',
                                        left: 'center'
                                    },
                                    tooltip: {
                                        trigger: 'item',
                                        formatter: '{b}: {c}%'
                                    },
                                    legend: {
                                        orient: 'horizontal',
                                        bottom: '0%'
                                    },
                                    series: [{
                                        name: 'Employment Status',
                                        type: 'pie',
                                        radius: '50%',
                                        data: chartData.employmentStatus,
                                        emphasis: {
                                            itemStyle: {
                                                shadowBlur: 10,
                                                shadowOffsetX: 0,
                                                shadowColor: 'rgba(0, 0, 0, 0.5)'
                                            }
                                        },
                                        itemStyle: {
                                            color: function(params) {
                                                const colors = ['#4CAF50', '#2196F3', '#FFC107', '#9C27B0', '#F44336', '#607D8B'];
                                                return colors[params.dataIndex];
                                            }
                                        }
                                    }]
                                };
                                pieChart.setOption(pieOption);
                                window.addEventListener('resize', function() {
                                    pieChart.resize();
                                });
                            });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Recent Job Postings</h5>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Company</th>
                                            <th>Position</th>
                                            <th>Location</th>
                                            <th>Deadline</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $jobsQuery = "SELECT * FROM job_postings WHERE status = 'active' ORDER BY application_deadline ASC LIMIT 5";
                                        $jobsResult = $conn->query($jobsQuery);
                                        while ($job = $jobsResult->fetch_assoc()) {
                                        ?>
                                        <tr>
                                            <td><?php echo $job['company_name']; ?></td>
                                            <td><?php echo $job['job_title']; ?></td>
                                            <td><?php echo $job['job_location']; ?></td>
                                            <td><?php echo date('M d, Y', strtotime($job['application_deadline'])); ?></td>
                                            <td><span class="badge bg-success">Active</span></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <?php include('inc/footer.php'); ?>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Store the selected batch for each card
        const cardBatchSelections = {
            'totalStudentsCard': 'all',
            'responseRateCard': 'all',
            'employmentRateCard': 'all',
            'employmentSectorCard': 'all'
        };
        
        // Function to update statistics for a specific card
        async function updateCardStatistics(cardId, batchId) {
            const card = document.getElementById(cardId);
            if (!card) {
                console.error(`Card with ID ${cardId} not found`);
                return;
            }

            // Get the correct stat element based on card type
            let statElement;
            switch(cardId) {
                case 'totalStudentsCard':
                    statElement = card.querySelector('#totalStudentsCount');
                    break;
                case 'responseRateCard':
                    statElement = card.querySelector('#responseRate');
                    break;
                case 'employmentRateCard':
                    statElement = card.querySelector('#employmentRate');
                    break;
                case 'employmentSectorCard':
                    // This card has multiple stat elements
                    break;
                default:
                    statElement = card.querySelector('h6');
            }

            const loadingElement = card.querySelector('.loading-spinner');
            const dropdownButton = card.querySelector('.dropdown button');
            
            if ((!statElement && cardId !== 'employmentSectorCard') || !loadingElement || !dropdownButton) {
                console.error(`Required elements not found in card ${cardId}`);
                return;
            }
            
            try {
                // Show loading state
                loadingElement.style.display = 'inline-block';
                if (statElement) {
                    statElement.style.display = 'none';
                }
                
                // Update dropdown button text to show selected batch
                const selectedBatchText = batchId === 'all' ? 'All Batches' : 
                    card.querySelector(`.dropdown-item[data-batch-id="${batchId}"]`).textContent;
                dropdownButton.innerHTML = `<i class="bi bi-three-dots-vertical"></i> ${selectedBatchText}`;

                // Log the request for debugging
                console.log(`Updating ${cardId} with batch ${batchId}`);

                const response = await fetch(`backend/get_batch_statistics.php?batch_id=${batchId}`);
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                
                const data = await response.json();
                console.log(`Response for ${cardId}:`, data);

                if (data.success) {
                    if (data.noData) {
                        if (statElement) {
                            statElement.textContent = 'No available data';
                            statElement.classList.add('text-muted');
                        }
                    } else {
                        if (statElement) {
                            statElement.classList.remove('text-muted');
                        }
                        
                        switch(cardId) {
                            case 'totalStudentsCard':
                                statElement.textContent = data.totalStudents.toLocaleString();
                                break;
                            case 'responseRateCard':
                                statElement.textContent = data.responseRate + '%';
                                break;
                            case 'employmentRateCard':
                                statElement.textContent = data.employmentRate + '%';
                                break;
                            case 'employmentSectorCard':
                                const govElement = document.getElementById('governmentPercentage');
                                const nonGovElement = document.getElementById('nonGovernmentPercentage');
                                if (govElement && nonGovElement) {
                                    govElement.textContent = data.governmentPercentage + '%';
                                    nonGovElement.textContent = data.nonGovernmentPercentage + '%';
                                } else {
                                    console.error('Government percentage elements not found');
                                }
                                break;
                        }
                    }
                    
                    // Update active state in dropdowns
                    const dropdown = card.querySelector('.dropdown-menu');
                    if (dropdown) {
                        dropdown.querySelectorAll('.dropdown-item').forEach(item => {
                            item.classList.remove('active');
                            if (item.getAttribute('data-batch-id') === batchId) {
                                item.classList.add('active');
                            }
                        });
                    }

                    // Store the selection
                    cardBatchSelections[cardId] = batchId;
                } else {
                    throw new Error(data.message || 'Failed to fetch statistics');
                }
            } catch (error) {
                console.error('Error:', error);
                if (statElement) {
                    statElement.textContent = 'Error loading data';
                    statElement.classList.add('text-danger');
                }
            } finally {
                loadingElement.style.display = 'none';
                if (statElement) {
                    statElement.style.display = 'block';
                }
            }
        }

        // Add event listeners to all dropdown items
        document.querySelectorAll('.dropdown-item').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault();
                const batchId = this.getAttribute('data-batch-id');
                const cardId = this.closest('.card').id;
                
                // Log the click event for debugging
                console.log(`Dropdown item clicked: ${batchId} for card ${cardId}`);
                
                // Update the card statistics
                updateCardStatistics(cardId, batchId);
            });
        });

        // Initialize all cards with 'all' batches
        ['totalStudentsCard', 'responseRateCard', 'employmentRateCard', 'employmentSectorCard'].forEach(cardId => {
            updateCardStatistics(cardId, 'all');
        });
    });
    </script>

    <style>
    .spin {
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
    .loading-spinner {
        display: none;
        margin-right: 5px;
    }
    .employment-sector {
        padding: 10px;
    }
    .employment-sector .col-6 {
        padding: 10px;
    }
    .employment-sector h6 {
        margin-bottom: 10px;
        font-size: 0.9rem;
    }
    .employment-sector h4 {
        font-size: 1.2rem;
        margin-top: 10px;
    }
    .dropdown-item.active {
        background-color: #4154f1;
        color: white;
    }
    .dropdown-item.active:hover {
        background-color: #3647d4;
    }
    .card .dropdown button {
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .card .dropdown button i {
        font-size: 1.2rem;
    }
    @media (max-width: 768px) {
        .employment-sector .col-6 {
            margin-bottom: 15px;
        }
    }
    </style>

</body>

</html>