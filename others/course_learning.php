<?php
session_start();
include 'header.php';

// Check if user is logged in and has purchased the course
if (!isset($_SESSION['id'])) {
    header("Location: signin.php");
    exit();
}

// Get course ID from URL
$course_id = isset($_GET['id']) ? $_GET['id'] : null;

if (!$course_id) {
    header("Location: courses.php");
    exit();
}

require '../DB/connect.php';
$db = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);

// Check if user has purchased this course
$user_id = $_SESSION['id'];
$check_purchase = "SELECT * FROM enroll_details ed 
                  JOIN enroll e ON ed.oid = e.id 
                  WHERE e.uid = $user_id AND ed.c_id = $course_id";
$purchase_result = mysqli_query($db, $check_purchase);

if (mysqli_num_rows($purchase_result) == 0) {
    header("Location: courses.php");
    exit();
}

// Get course details
$query = "SELECT * FROM courses WHERE c_id = $course_id";
$result = mysqli_query($db, $query);
$course = mysqli_fetch_assoc($result);

// Get course content
require 'course_content.php';
$content = get_course_content($course_id);

if (!$content) {
    header("Location: courses.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <style>
        .sidebar {
            height: calc(100vh - 76px);
            overflow-y: auto;
        }
        .video-container {
            position: relative;
            padding-bottom: 56.25%;
            height: 0;
            overflow: hidden;
        }
        .video-container iframe {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .lesson-item {
            cursor: pointer;
            padding: 10px;
            margin: 5px 0;
            border-radius: 5px;
            transition: all 0.3s;
        }
        .lesson-item:hover {
            background-color: #f8f9fa;
        }
        .lesson-item.active {
            background-color: #e9ecef;
        }
        .course-progress {
            height: 8px;
        }
    </style>
</head>
<body>

<div class="container-fluid mt-4">
    <div class="row">
        <!-- Course Content Sidebar -->
        <div class="col-md-3">
            <div class="card sidebar">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Course Content</h5>
                </div>
                <div class="card-body p-0">
                    <!-- Course Progress -->
                    <div class="p-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-muted">Your Progress</span>
                            <span class="badge bg-success">30%</span>
                        </div>
                        <div class="progress course-progress">
                            <div class="progress-bar" role="progressbar" style="width: 30%" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>

                    <!-- Course Sections -->
                    <div class="accordion" id="courseContent">
                        <?php foreach ($content['sections'] as $index => $section) : ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button <?php echo $index > 0 ? 'collapsed' : ''; ?>" type="button" data-bs-toggle="collapse" data-bs-target="#section<?php echo $index; ?>">
                                        <?php echo $section['title']; ?>
                                    </button>
                                </h2>
                                <div id="section<?php echo $index; ?>" class="accordion-collapse collapse <?php echo $index === 0 ? 'show' : ''; ?>">
                                    <div class="accordion-body p-0">
                                        <?php foreach ($section['lessons'] as $lesson) : ?>
                                            <div class="lesson-item d-flex justify-content-between align-items-center p-3" 
                                                 onclick="playVideo('<?php echo $lesson['video_id']; ?>')">
                                                <div>
                                                    <i class="fas fa-play-circle me-2"></i>
                                                    <?php echo $lesson['title']; ?>
                                                </div>
                                                <span class="text-muted small"><?php echo $lesson['duration']; ?></span>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Area -->
        <div class="col-md-9">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title mb-4"><?php echo htmlspecialchars($course['c_name']); ?></h2>
                    
                    <!-- Video Player -->
                    <div class="video-container mb-4">
                        <iframe id="videoPlayer" 
                                src="https://www.youtube.com/embed/<?php echo $content['video_id']; ?>?rel=0&controls=1&showinfo=0&modestbranding=1&iv_load_policy=3" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>

                    <!-- Course Description -->
                    <div class="mt-4">
                        <h4>About This Course</h4>
                        <p><?php echo htmlspecialchars($course['description']); ?></p>
                    </div>

                    <!-- Course Resources -->
                    <div class="mt-4">
                        <h4>Course Resources</h4>
                        <div class="list-group">
                            <?php foreach ($content['resources'] as $resource) : ?>
                                <a href="#" class="list-group-item list-group-item-action">
                                    <i class="fas <?php echo $resource['icon']; ?> me-2"></i>
                                    <?php echo $resource['title']; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function playVideo(videoId) {
    // Update video player with the selected video
    document.getElementById('videoPlayer').src = 'https://www.youtube.com/embed/' + videoId + '&rel=0&controls=1&showinfo=0&modestbranding=1&iv_load_policy=3';
    
    // Update active lesson styling
    document.querySelectorAll('.lesson-item').forEach(item => {
        item.classList.remove('active');
    });
    event.currentTarget.classList.add('active');
}
</script>

<?php include 'footer.php'; ?>
</body>
</html> 