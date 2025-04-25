<?php
session_start();
include 'header.php';
?>

<div class="container py-5">
    <!-- Hero Section -->
    <div class="row align-items-center mb-5">
        <div class="col-lg-6">
            <h1 class="display-4 fw-bold mb-4">About E-Patsala</h1>
            <p class="lead text-muted">Empowering minds through accessible digital education</p>
            <p class="mb-4">E-Patsala is a leading online learning platform dedicated to making quality education accessible to everyone. Our mission is to transform lives through knowledge and skill development in the digital age.</p>
        </div>
        <div class="col-lg-6">
            <img src="../images/working.png" alt="E-learning illustration" class="img-fluid rounded shadow">
        </div>
    </div>

    <!-- Our Mission -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold mb-4">Our Mission</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-graduation-cap text-primary fa-2x"></i>
                            </div>
                            <h5 class="card-title fw-bold">Quality Education</h5>
                            <p class="card-text">Providing high-quality educational content created by industry experts and experienced educators.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-globe text-primary fa-2x"></i>
                            </div>
                            <h5 class="card-title fw-bold">Global Access</h5>
                            <p class="card-text">Making education accessible to learners worldwide through our digital platform.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="mb-3">
                                <i class="fas fa-users text-primary fa-2x"></i>
                            </div>
                            <h5 class="card-title fw-bold">Community Learning</h5>
                            <p class="card-text">Building a supportive community of learners, educators, and industry professionals.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Why Choose Us -->
    <div class="row mb-5">
        <div class="col-12">
            <h2 class="fw-bold mb-4">Why Choose E-Patsala?</h2>
            <div class="row g-4">
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-check-circle text-success fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Expert Instructors</h5>
                            <p>Learn from industry professionals and experienced educators</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-clock text-success fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Flexible Learning</h5>
                            <p>Study at your own pace and on your own schedule</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-certificate text-success fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">Certificates</h5>
                            <p>Earn recognized certificates upon course completion</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="d-flex align-items-start">
                        <div class="me-3">
                            <i class="fas fa-headset text-success fa-2x"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold">24/7 Support</h5>
                            <p>Get help whenever you need it from our support team</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics -->
    <div class="row mb-5 py-5 bg-light rounded">
        <div class="col-12 text-center mb-4">
            <h2 class="fw-bold">Our Impact</h2>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <h2 class="fw-bold text-primary">3.2K+</h2>
            <p class="text-muted">Online Courses</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <h2 class="fw-bold text-primary">600+</h2>
            <p class="text-muted">Expert Instructors</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <h2 class="fw-bold text-primary">10K+</h2>
            <p class="text-muted">Active Students</p>
        </div>
        <div class="col-lg-3 col-md-6 text-center mb-4">
            <h2 class="fw-bold text-primary">95%</h2>
            <p class="text-muted">Satisfaction Rate</p>
        </div>
    </div>

    <!-- Call to Action -->
    <div class="row">
        <div class="col-12 text-center">
            <h2 class="fw-bold mb-4">Ready to Start Learning?</h2>
            <p class="lead mb-4">Join thousands of students already learning on E-Patsala</p>
            <a href="courses.php" class="btn btn-primary btn-lg px-5">Browse Courses</a>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?> 