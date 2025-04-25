<?php 
session_start();
require 'others/header.php';
?>
<!DOCTYPE html>
<html lang="en">
<body>
  
<header class="container">
        <!-- Slider Start -->
        <section class="mt-5 container h-100 mb-5">
            <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner position-relative">
                    <div class="carousel-item active">
                        <img src="images/cover-1.png" class="d-block w-100 rounded" alt="cover 1">
                        <div class="container-fluid carousel-caption d-flex flex-column h-100 align-items-center justify-content-center p-5 position-absolute start-0 bottom-0 bg-black rounded" style="--bs-bg-opacity: .5;">
                            <h1 class="display-2 fw-bold w-75 sliderHeader">Get Started Digital Learning</h1>
                            <p class="sliderPara">We Are The Top Performing E-learning Platform</p>
                            <button class="btn btn-primary fs-4 fw-bold sliderBtn">Get Started</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/cover-2.jpg" class="d-block w-100 rounded" alt="cover 2">
                        <div class="container-fluid carousel-caption d-flex flex-column h-100 align-items-center justify-content-center p-5 position-absolute start-0 bottom-0 bg-black rounded" style="--bs-bg-opacity: .5;">
                            <h1 class="display-2 fw-bold w-75 sliderHeader">Get Started Digital Learning</h1>
                            <p class="sliderPara">Get A Chance To Shine In Your Life</p>
                            <button class="btn btn-primary fs-4 fw-bold sliderBtn">Get Started</button>
                        </div>
                    </div>
                    <div class="carousel-item">
                        <img src="images/cover-3.jpg" class="d-block w-100 rounded" alt="cover 3">
                        <div class="container-fluid carousel-caption d-flex flex-column h-100 align-items-center justify-content-center p-5 position-absolute start-0 bottom-0 bg-black rounded" style="--bs-bg-opacity: .5;">
                            <h1 class="display-2 fw-bold w-75 sliderHeader">Get Started Digital Learning</h1>
                            <p class="sliderPara">We Are Always Here For You</p>
                            <button class="btn btn-primary fs-4 fw-bold sliderBtn">Get Started</button>
                        </div>
                    </div>
                </div>
                <button class="carousel-control-prev d-none d-md-block d-lg-block d-xl-block d-xxl-block" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next d-none d-md-block d-lg-block d-xl-block d-xxl-block" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>
        </section>
        <!-- Slider End -->
    </header>             

    <main>
        <!-- Courses Section Start -->
 <section class="container">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold">Discover Our Popular Courses</h1>
        <p class="lead">Our popular courses are listed below</p>
    </div>
   
    <div class="row g-4">
        <?php
        require 'DB/connect.php';
        $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
        $query = "SELECT * FROM courses";
        $result = mysqli_query($db,$query) or die("Query failed: ".mysqli_error($db));
        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>
            <div class="col-12 col-sm-6 col-lg-4">
                <div class="card h-100 shadow-sm border-0">
                    <img src="DB/<?php echo htmlspecialchars($row['c_image']); ?>"
                         class="card-img-top"
                         style="height: 200px; object-fit: cover;"
                         alt="<?php echo htmlspecialchars($row['c_name']); ?>">
                   
                    <div class="card-body d-flex flex-column p-4">
                        <div class="mb-3">
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
                            <span class="badge bg-primary mb-2"><?php echo strtoupper($row['category'] ?? 'CODE'); ?></span>
                            <?php if($purchased) { ?>
                                <span class="badge bg-success mb-2 ms-2">Purchased</span>
                            <?php } ?>
                            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($row['c_name']); ?></h5>
                            <p class="text-muted small mb-2"><?php echo htmlspecialchars($row['subtitle'] ?? ''); ?></p>
                        </div>
                        
                        <p class="card-text flex-grow-1 text-muted"><?php echo htmlspecialchars($row['description']); ?></p>
                        
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span class="text-primary fw-bold">$<?php echo number_format($row['price']); ?></span>
                            <?php if($purchased) { ?>
                                <a href="others/course_learning.php?id=<?php echo $row['c_id']; ?>" class="btn btn-sm btn-success px-3">
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
</section>
        <!-- Courses Section End -->

        <!-- Explore Section Start -->
        <section class="container mb-5 pb-5 pt-5">
            <div class="card border rounded-0">
                <div class="row g-0">
                    <div class="col-md-6 col-lg-4">
                        <img src="images/working.png" class="img-fluid" alt="">
                    </div>
                    <div class="col-md-6 col-lg-8 d-flex  exploreColor">
                        <div class="card-body px-lg-5 d-flex flex-column justify-content-center">
                            <h1 class="fw-bold pb-lg-2">Explore The E-Patsala Institute</h1>
                            <p class="">Our institute is the market-leading e-learning platform. By joining our institute you can learn so many things. Nowadays e-learning is the best platform for learning. We offer you many courses, from which you can choose one or more.</p>
                            <div class="d-flex my-md-3 my-lg-3">
                                <div class="pe-md-3 pe-lg-5">
                                    <h1 class="fw-bold">3.2K+</h1>
                                    <h5>Online Course</h5>
                                </div>
                                <div class="pe-md-3 pe-lg-5">
                                    <h1 class="fw-bold">600+</h1>
                                    <h5>Expert Member</h5>
                                </div>
                                <div class="pe-md-3 pe-lg-5">
                                    <h1 class="fw-bold">1K+</h1>
                                    <h5>Rating & Review</h5>
                                </div>
                            </div>
                            <div>
                                <button class="btn btn-primary fw-bold px-4 py-2">Read More</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Explore Section End -->

        <!-- Ready To Join Section Start -->
        <section class="container mt-5 mb-5">
            <div class="d-md-block d-lg-flex justify-content-between align-items-center bg-info rounded p-5 text-center text-lg-start">
                <div class="text-white">
                    <h1 class="fw-bold">Ready To Join?</h1>
                    <p>We have so many courses, that you can enroll. Register for enrollment.</p>
                </div>
                <?php if(array_key_exists('id',$_SESSION)){?>
                    <div>
                        <button type="button" class="btn btn-light px-3 py-2 text-info fw-bold" disabled>Register Now</button>
                    </div>
                <?php } else{
                ?>
                    <div>
                        <form method="post" action="others/signin.php">
                            <button type="submit" class="btn btn-light px-3 py-2 text-info fw-bold">Register Now</button>
                        </form>
                    </div>
            <?php }?>
            </div>
        </section>
        <!-- Ready To Join Section End -->

        <!-- Successfull Students Section Start -->
        <section class="container mb-5 pt-5">
            <div>
                <div class="mb-5 text-center text-md-start">
                    <h1 class="fw-bold pb-4">Meet Our Successfull Students</h1>
                    <p class="text-secondary">Those are our successfull students. They took our courses and performed well.</p>
                </div>
                <div class="row g-3 mb-5">
                    <!-- Single Student -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="border rounded">
                            <img src="images/student-1.png" class="img-fluid col-md-12 col-12" alt="Student 1">
                            <div class="ps-3 pt-3">
                                <p class="text-secondary">
                                    <span class="text-dark fw-bold">Awlad Hossain</span><br>UI/UX Designer
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Student -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="border rounded">
                            <img src="images/student-2.png" class="img-fluid col-md-12 col-12" alt="Student 2">
                            <div class="ps-3 pt-3">
                                <p class="text-secondary">
                                    <span class="text-dark fw-bold">Jannatul Islam</span><br>Motion Design
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Student -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="border rounded">
                            <img src="images/student-3.png" class="img-fluid col-md-12 col-12" alt="Student 3">
                            <div class="ps-3 pt-3">
                                <p class="text-secondary">
                                    <span class="fw-bold text-dark">Imran Hossain</span><br>Graphic Designer
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Single Student -->
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="border rounded">
                            <img src="images/student-4.png" class="img-fluid col-md-12 col-12" alt="Student 4">
                            <div class="ps-3 pt-3">
                                <p class="text-secondary">
                                    <span class="fw-bold text-dark">Nishi Akter</span><br>Web Developer
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-center">
                    <button class="btn btn-primary fw-bold px-4 py-2">View All</button>
                </div>
            </div>
        </section>
        <!-- Successfull Students Section End -->

        <!-- Students Feedback Start -->
        <section class="container">
            <div>
                <div class="text-center">
                    <h1 class="fw-bolder">Some Students Feedback</h1>
                    <p>Here is some feedback from our formal students</p>
                </div>
                <div>
                    <div class="row g-3 mb-5">
                        <!-- Single Student Feedback -->
                        <div class="col-lg-6">
                            <div class="border rounded p-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="images/comma.png" alt="Comma">
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-regular fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <p class="text-secondary">This E-Learning platform is very good. I took a course in web development. They teach us properly. It's interesting that, From a beginner, right now I am a professional web developer. Thanks to E-Patsala institute.</p>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <img src="images/student-5.png" class="img-fluid" alt="Student 5">
                                    </div>
                                    <p class="ps-3 text-secondary"><span class="text-dark fw-bold">Awlad Hossain</span><br>Web Developer</p>
                                </div>
                            </div>
                        </div>
                        <!-- Single Student Feedback -->
                        <div class="col-lg-6">
                            <div class="border rounded p-4">
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <img src="images/comma.png" alt="Comma">
                                    </div>
                                    <div>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-solid fa-star text-warning"></i>
                                        <i class="fa-regular fa-star text-warning"></i>
                                    </div>
                                </div>
                                <div class="py-3">
                                    <p class="text-secondary">This E-Learning platform is very good. I took a course in graphics design. They teach us properly. It's interesting that, From a beginner, right now I am a professional graphics designer. Thanks to E-Patsala institute.</p>
                                </div>
                                <div class="d-flex">
                                    <div>
                                        <img src="images/student-6.png" class="img-fluid" alt="Student 6">
                                    </div>
                                    <p class="ps-3 text-secondary"><span class="fw-bold text-dark">Shanta Akter</span><br>Graphic Designer</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mb-5 d-lg-none">
                <button class="btn btn-primary fw-bold px-4 py-2">View All</button>
            </div>
        </section>
        <!-- Students Feedback End -->

        <!-- Accordion Start -->
        <section class="container">
            <div class="text-center mb-5">
                <h1 class="fw-bold">Frequently Asked Questions</h1>
                <p class="text-secondary">Some frequently asked questions answers are given below,</p>
            </div>
            <div class="accordion" id="accordionExample">
                <!-- 1st Question -->
                <div class="accordion-item my-4 border-0">
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button fw-bold border rounded-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                            What are the differences between flexbox and grid?
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-secondary">
                            The basic difference between flexbox and grid Layout is that flexbox was designed for layout in one dimension - either a row or a column. Grid was designed for two-dimensional layout - rows, and columns at the same time.
                        </div>
                    </div>
                </div>
                <!-- 2nd Question -->
                <div class="accordion-item my-4 border-0">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed fw-bold border rounded-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            What are the differences between bootstrap and tailwind CSS?
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-secondary">
                            The main difference between TailwindCSS and Bootstrap is that Tailwind CSS is not a UI kit. Unlike UI kits such as Bootstrap, Tailwind CSS doesn't have a default theme or built-in UI components. Instead, it comes with predesigned widgets you can use to build your site from scratch.
                        </div>
                    </div>
                </div>
                <!-- 3rd Question -->
                <div class="accordion-item my-4 border-0">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed fw-bold border rounded-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            What is CSS Box Model?
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-secondary">
                            The CSS box model is essentially a box that wraps around every HTML element. It consists of: margins, borders, padding, and the actual content.
                        </div>
                    </div>
                </div>
                <!-- 4th Question -->
                <div class="accordion-item my-4 border-0">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed fw-bold border rounded-2" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            What is a Semantic tag?
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body text-secondary">
                            The HTML semantics refers to the tags that provide meaning to an HTML page rather than just presentation. It makes HTML more comprehensible by better defining the different sections and layout of web pages.
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Accordion End -->

        <!-- Trusted Companies Section Start -->
        <section class="d-none d-lg-block container mt-5">
            <div>
                <div class="text-center pb-5">
                    <h1 class="fw-bold">Trusted by over 800+ companies</h1>
                </div>
                <div class="d-flex justify-content-between mb-5 pb-5">
                    <div><img src="images/company-1.png" alt="Company 1"></div>
                    <div><img src="images/company-2.png" alt="Company 2"></div>
                    <div><img src="images/company-3.png" alt="Company 3"></div>
                    <div><img src="images/company-4.png" alt="Company 4"></div>
                    <div><img src="images/company-5.png" alt="Company 5"></div>
                    <div><img src="images/company-6.png" alt="Company 6"></div>
                </div>
            </div>
        </section>
        <!-- Trusted Companies Section End -->
    </main>

    <!-- Footer -->

    <!-- Footer Start -->
    <footer class="bg-dark p-5">
        <div class="text-white text-center mt-5">
            <h1 class="fw-bold">E-Patsala</h1>
            <p>6/1 Shah Road, Narayanganj,<br>Bangladesh</p>
            <p>Privacy Ploicy | Terms of use</p>
        </div>
        <div class="text-center display-6 mb-5">
            <a href="https://www.facebook.com" target="_blank"><i class="fa-brands fa-facebook-square text-white px-2"></i></a>
            <a href="https://twitter.com" target="_blank"><i class="fa-brands fa-twitter text-white px-2"></i></a>
            <a href="https://www.instagram.com" target="_blank"><i class="fa-brands fa-instagram text-white px-2"></i></a>
            <a href="https://www.linkedin.com" target="_blank" ><i class="fa-brands fa-linkedin text-white px-2"></i></a>
        </div>
    </footer>
    <!-- Footer End -->

    <script>
        // Wait for the document to be ready before initializing the carousel manipulation
        document.addEventListener("DOMContentLoaded", function () {
            const carousel = new bootstrap.Carousel('#carouselExampleCaptions', {
                interval: 2000,  // Set the automatic slide transition interval to 2 seconds
                ride: 'carousel',  // Automatically start sliding
            });

            // Manually triggering the carousel to swap images after a 2-second gap
            setInterval(function () {
                carousel.next();  // Move to the next image every 2 seconds
            }, 4000);  // The 4000ms delay allows for a 2-second gap between swaps
        });
    </script>


    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>