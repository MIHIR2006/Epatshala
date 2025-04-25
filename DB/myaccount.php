<?php session_start(); ?>
<!DOCTYPE html>
<html>
<body>

  <?php
    require '../others/header.php';

if (!isset($_SESSION['id'])) {
    header("Location: ../others/signin.php");
    exit();
}

require 'connect.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
$user_id = $_SESSION['id'];

// Get user details
$query = "SELECT * FROM user WHERE id = $user_id";
$result = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($result);

// Get purchased courses
$courses_query = "SELECT c.*, o.order_date 
                 FROM courses c 
                 JOIN order_details od ON c.c_id = od.course_id 
                 JOIN orders o ON od.order_id = o.id 
                 WHERE o.user_id = $user_id 
                 ORDER BY o.order_date DESC";
$courses_result = mysqli_query($db, $courses_query);
?>

<div class="container py-5">
    <div class="row">
        <!-- User Profile Section -->
        <div class="col-lg-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <div class="text-center mb-4">
                        <img src="../images/blank-profile-picture-973460_1280.png" 
                             alt="Profile Picture" 
                             class="rounded-circle mb-3" 
                             style="width: 150px; height: 150px; object-fit: cover;">
                        <h4><?php echo htmlspecialchars($user['name']); ?></h4>
                        <p class="text-muted"><?php echo htmlspecialchars($user['email']); ?></p>
                        <a href="../others/logout.php" class="btn btn-danger mt-3">
                            <i class="fas fa-sign-out-alt me-2"></i>Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Content Section -->
        <div class="col-lg-8">
            <div class="tab-content">
                <!-- Profile Tab -->
                <div class="tab-pane fade show active" id="profile">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Profile Information</h5>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" readonly>
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- My Courses Tab -->
                <div class="tab-pane fade" id="courses">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">My Purchased Courses</h5>
                            
                            <?php if (mysqli_num_rows($courses_result) > 0): ?>
                                <div class="row row-cols-1 row-cols-md-2 g-4">
                                    <?php while ($course = mysqli_fetch_assoc($courses_result)): ?>
                                        <div class="col">
                                            <div class="card h-100">
                                                <img src="DB/<?php echo htmlspecialchars($course['c_image']); ?>" 
                                                     class="card-img-top" 
                                                     style="height: 140px; object-fit: cover;"
                                                     alt="<?php echo htmlspecialchars($course['c_name']); ?>">
                                                <div class="card-body">
                                                    <h5 class="card-title"><?php echo htmlspecialchars($course['c_name']); ?></h5>
                                                    <p class="card-text small text-muted mb-2">
                                                        Purchased on: <?php echo date('F j, Y', strtotime($course['order_date'])); ?>
                                                    </p>
                                                    <a href="../others/course_learning.php?id=<?php echo $course['c_id']; ?>" 
                                                       class="btn btn-success btn-sm">
                                                        <i class="fas fa-play-circle me-1"></i>Continue Learning
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php else: ?>
                                <div class="text-center py-5">
                                    <i class="fas fa-graduation-cap fa-3x text-muted mb-3"></i>
                                    <h6>You haven't purchased any courses yet</h6>
                                    <p class="text-muted">Browse our courses and start learning today!</p>
                                    <a href="../others/courses.php" class="btn btn-primary">Browse Courses</a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Settings Tab -->
                <div class="tab-pane fade" id="settings">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title mb-4">Account Settings</h5>
                            <form>
                                <div class="mb-3">
                                    <label class="form-label">Change Password</label>
                                    <input type="password" class="form-control mb-2" placeholder="Current Password">
                                    <input type="password" class="form-control mb-2" placeholder="New Password">
                                    <input type="password" class="form-control" placeholder="Confirm New Password">
                                </div>
                                <button type="submit" class="btn btn-primary">Update Password</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require '../others/footer.php'; ?>