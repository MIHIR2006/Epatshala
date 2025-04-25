<?php
session_start();
require 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Popular Courses</title>
</head>
<body>
    <main>
        <!-- Courses Section Start -->
        <section class="container py-5">
            <div class="text-center mb-5">
                <h1 class="display-5 fw-bold">Discover Our Popular Courses</h1>
                <p class="lead">Our popular courses are listed below</p>
            </div>
            
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 justify-content-center">
                <?php
                require '../DB/connect.php';
                $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
                $query = "SELECT * FROM courses LIMIT 6"; // Limit to 6 courses initially
                $result = mysqli_query($db,$query) or die("Query failed: ".mysqli_error($db));

                while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="../DB/<?php echo htmlspecialchars($row['c_image']); ?>" 
                                 class="card-img-top" 
                                 style="height: 180px; object-fit: cover;"
                                 alt="<?php echo htmlspecialchars($row['c_name']); ?>">
                            
                            <div class="card-body d-flex flex-column">
                                <?php
                                // Check if user is logged in and has purchased the course
                                $purchased = false;
                                if(isset($_SESSION['id'])) {
                                    $user_id = $_SESSION['id'];
                                    $course_id = $row['c_id'];
                                    $check_purchase = "SELECT * FROM enroll_details ed 
                                                     JOIN enroll e ON ed.oid = e.id 
                                                     WHERE e.uid = $user_id AND ed.c_id = $course_id";
                                    $purchase_result = mysqli_query($db, $check_purchase);
                                    $purchased = mysqli_num_rows($purchase_result) > 0;
                                }
                                ?>
                                <h2 class="card-title h5">
                                    <?php echo htmlspecialchars($row['c_name']); ?>
                                    <?php if($purchased) { ?>
                                        <span class="badge bg-success ms-2">Purchased</span>
                                    <?php } ?>
                                </h2>
                                <p class="card-text flex-grow-1"><?php echo htmlspecialchars($row['description']); ?></p>
                                
                                <div class="d-flex justify-content-between align-items-center mt-3">
                                    <span class="text-primary fw-bold">$<?php echo number_format($row['price']); ?></span>
                                    <?php if($purchased) { ?>
                                        <a href="course_learning.php?id=<?php echo $row['c_id']; ?>" class="btn btn-sm btn-success px-3">
                                            <i class="fas fa-play-circle me-1"></i>Start Learning
                                        </a>
                                    <?php } else { ?>
                                        <?php if(isset($_SESSION['id'])) { ?>
                                            <form method="post" action="<?php echo base_url; ?>DB/add_to_cart.php">
                                                <input type="hidden" name="id" value="<?php echo $row['c_id']; ?>">
                                                <input type="hidden" name="cname" value="<?php echo htmlspecialchars($row['c_name']); ?>">
                                                <input type="hidden" name="price" value="<?php echo $row['price']; ?>">
                                                <button type="submit" class="btn btn-sm btn-primary px-3">Get Course</button>
                                            </form>
                                        <?php } else { ?>
                                            <a href="<?php echo base_url; ?>others/signin.php" class="btn btn-sm btn-primary px-3">Get Course</a>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            
            <div class="text-center mt-5">
                <a href="<?php echo base_url; ?>courses/all" class="btn btn-primary px-4 py-2 fw-bold">See More Courses</a>
            </div>
        </section>
    </main>
    
    <?php require 'footer.php'; ?>
    
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>