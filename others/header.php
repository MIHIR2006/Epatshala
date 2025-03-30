<!DOCTYPE html>
<html>

<?php 
error_reporting(0);
define('base_url', "http://localhost/Epatshala/");?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap Link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">

    <!-- Font Awsome -->
    <script src="https://kit.fontawesome.com/cf9cbf3728.js" crossorigin="anonymous"></script>

    <!-- Custom CSS -->
    <style>
        .exploreColor{
            background-color: #F4FAFD;
        }

        @media only screen and (max-width: 688px){
            .sliderHeader{
                font-size: 3vh;
            }

            .sliderPara{
                font-size: 2vh;
            }

            .sliderBtn{
                font-size: 3vh;
            }

            .height{
                height: 50%;
            }
        }
    </style>

    <title>E-Patsala</title>
</head>
<body>
<!-- Navbar Start -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand fs-2 fw-bold" href="<?php echo base_url; ?>index.php">E-Patsala</a>
                <div class="d-flex justify-content-end">
                    <?php 
                    if (array_key_exists('id',$_SESSION)){
                ?>
                        <!-- Add onclick event for logout button -->
                        <button 
                            type="button" 
                            class="btn btn-outline-info d-none d-md-block d-lg-none me-3 fw-bold"
                            onclick="logoutAlert()">Log out</button>
                <?php } else{ ?>
                        <a style="text-decoration: none;" href="<?php echo base_url; ?>others/signin.php">
                        <button type="button" class="btn btn-outline-info d-none d-md-block d-lg-none me-3 fw-bold">log in</button>
                        </a>

                <?php } ?>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse d-lg-flex justify-content-center" id="navbarNav">
                    <ul class="navbar-nav">
                        <li class="nav-item px-4">
                            <a class="nav-link fw-semibold" href="<?php echo base_url; ?>index.php">Home</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link fw-semibold" href="<?php echo base_url; ?>others/courses.php">Courses</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link fw-semibold" href="#">About</a>
                        </li>
                        <li class="nav-item px-4">
                            <a class="nav-link fw-semibold" href="<?php echo base_url; ?>DB/cart.php">Cart</a>
                        </li>
                        <?php 
                            if (array_key_exists('id',$_SESSION)){
                        ?>
                                <li class="nav-item px-4">
                                    <a class="nav-link fw-semibold" href="<?php echo base_url; ?>DB/myaccount.php">My Account</a>
                                </li>
                        <?php }?>
                    </ul>
                </div>
                <?php 
                    if (array_key_exists('id',$_SESSION)){
                ?>
                        <!-- Add onclick event for logout button -->
                        <button 
                            type="button" 
                            class="btn btn-outline-info fw-bold d-none d-lg-block d-xl-block d-xxl-block"
                            onclick="logoutAlert()">Log out</button>
                <?php } else{ ?>
                        <a style="text-decoration: none;" href="<?php echo base_url; ?>others/signin.php">
                        <button type="button" class="btn btn-outline-info fw-bold d-none d-lg-block d-xl-block d-xxl-block">Log in</button>
                        </a>

                <?php } ?>
            </div>
        </nav>
        <!-- Navbar End -->

    <script type="text/javascript">
        // JavaScript function to show an alert before logging out
        function logoutAlert() {
            // Display an alert box before proceeding with the logout
            if (confirm("Are you sure you want to log out?")) {
                // Redirect to logout page if user confirms
                window.location.href = "<?php echo base_url; ?>DB/logout.php";
            }
        }
    </script>

</body>
</html>
