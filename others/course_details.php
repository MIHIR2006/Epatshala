<?php
session_start();
include 'header.php';

if (!isset($_GET['id'])) {
    header("Location: courses.php");
    exit();
}

require '../DB/connect.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$course_id = $_GET['id'];

// Get course details
$query = "SELECT * FROM courses WHERE c_id = $course_id";
$result = mysqli_query($db, $query);
$course = mysqli_fetch_assoc($result);

// Check if user has purchased this course
$has_purchased = false;
if (isset($_SESSION['id'])) {
    $user_id = $_SESSION['id'];
    $check_purchase = "SELECT * FROM enroll_details ed 
                      JOIN enroll e ON ed.oid = e.id 
                      WHERE e.uid = $user_id AND ed.c_id = $course_id";
    $purchase_result = mysqli_query($db, $check_purchase);
    $has_purchased = mysqli_num_rows($purchase_result) > 0;
}
?>

<div class="container py-5">
    <div class="row">
        <div class="col-lg-8">
            <!-- Course Preview -->
            <div class="card mb-4">
                <img src="../DB/<?php echo htmlspecialchars($course['c_image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($course['c_name']); ?>">
                <div class="card-body">
                    <h1 class="card-title"><?php echo htmlspecialchars($course['c_name']); ?></h1>
                    <p class="text-muted"><?php echo htmlspecialchars($course['subtitle'] ?? ''); ?></p>
                    
                    <?php if ($has_purchased): ?>
                        <a href="course_learning.php?id=<?php echo $course_id; ?>" class="btn btn-success btn-lg">
                            <i class="fas fa-play-circle me-2"></i>Start Learning
                        </a>
                    <?php else: ?>
                        <form method="post" action="<?php echo base_url; ?>DB/add_to_cart.php">
                            <input type="hidden" name="id" value="<?php echo $course_id; ?>">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-shopping-cart me-2"></i>Add to Cart - $<?php echo number_format($course['price'], 2); ?>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Course Description -->
            <div class="card mb-4">
                <div class="card-body">
                    <h3>About This Course</h3>
                    <p><?php echo nl2br(htmlspecialchars($course['description'])); ?></p>
                </div>
            </div>

            <!-- Course Syllabus -->
            <div class="card">
                <div class="card-body">
                    <h3>Course Syllabus</h3>
                    <div class="accordion" id="courseSyllabus">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#section1">
                                    Section 1: Introduction
                                </button>
                            </h2>
                            <div id="section1" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-play-circle me-2 text-muted"></i>
                                            Welcome to the Course
                                            <span class="text-muted small ms-2">5:20</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-play-circle me-2 text-muted"></i>
                                            Course Overview
                                            <span class="text-muted small ms-2">8:15</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#section2">
                                    Section 2: Getting Started
                                </button>
                            </h2>
                            <div id="section2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    <ul class="list-unstyled">
                                        <li class="mb-2">
                                            <i class="fas fa-play-circle me-2 text-muted"></i>
                                            Setting Up Environment
                                            <span class="text-muted small ms-2">12:30</span>
                                        </li>
                                        <li class="mb-2">
                                            <i class="fas fa-play-circle me-2 text-muted"></i>
                                            Basic Concepts
                                            <span class="text-muted small ms-2">15:45</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-body">
                    <h4>This course includes:</h4>
                    <ul class="list-unstyled">
                        <li class="mb-3">
                            <i class="fas fa-video me-2 text-primary"></i>
                            4 hours of video content
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-file-pdf me-2 text-primary"></i>
                            Downloadable resources
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-infinity me-2 text-primary"></i>
                            Full lifetime access
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-mobile-alt me-2 text-primary"></i>
                            Access on mobile and desktop
                        </li>
                        <li class="mb-3">
                            <i class="fas fa-certificate me-2 text-primary"></i>
                            Certificate of completion
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?> 