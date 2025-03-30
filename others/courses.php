<?php
session_start();
require 'header.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<body>
    <main>
        <!-- Courses Section Start -->
        <section class="container-fluid d-flex justify-content-center">
            <div class="d-flex flex-column align-items-center justify-content-center text-center col-lg-10 col-md-11 col-sm-11">
                <div class="mb-5">
                    <h1 class="fs-1 fw-bold">Discover Our Popular Courses</h1>
                    <p>Our popular courses are listed below</p>
                </div>
                <div class="gap-4 d-flex flex-wrap justify-content-center">
                    <?php

                        require '../DB/connect.php';

                        $db = mysqli_connect(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

                        $query = "SELECT * FROM courses";

                        $result = mysqli_query($db,$query) or die("query doesn't run ".mysqli_error($db));

                        while($row = mysqli_fetch_array($result,MYSQLI_ASSOC)) { ?>

                            <article class="d-block d-lg-flex d-md-flex border rounded col-12 col-lg-5 col-md-12 col-sm-12">
                                <div class="d-flex height">
                                    <?php echo "<img src=../DB/".$row['c_image']." class='flex-fill'>";?>
                                </div>
                                <div class="d-flex flex-column justify-content-center px-3 text-start height">
                                    <h2 class="fs-4 fw-bold"><?php echo "$row[c_name]"?></h2>
                                    <p><?php echo "$row[description]"?></p>

                                    <?php if(array_key_exists('id',$_SESSION)){?>
                                            <form method="post" action="<?php echo base_url; ?>DB/add_to_cart.php">
                                              <input type="hidden" name="id" value="<?php echo "$row[c_id]";?>">
                                              <input type="hidden" name="cname" value="<?php echo "$row[c_name]";?>">
                                              <input type="hidden" name="price" value="<?php echo "$row[price]";?>">
                                            <h3 class="fs-5 text-primary tw-bold">Price : <?php echo "$row[price]"?>$</h3>
                                            <button type = "submit" class="btn btn-primary fw-bold px-4 py-2 mt-2 mb-2">Get Course</button>
                                            </form>
                                    <?php } else{
                                    ?>
                                        <form method="post" action="<?php echo base_url; ?>others/signin.php">
                                          <input type="hidden" name="id" value="<?php echo "$row[c_id]";?>">
                                          <input type="hidden" name="cname" value="<?php echo "$row[c_name]";?>">
                                          <input type="hidden" name="price" value="<?php echo "$row[price]";?>">
                                        <h3 class="fs-5 text-primary tw-bold">Price : <?php echo "$row[price]"?>$</h3>
                                        <button type = "submit" class="btn btn-primary fw-bold px-4 py-2 mt-2 mb-2">Get Course</button>
                                        </form>
                                <?php }?>
                                </div>
                            </article>


                       <?php } ?>
                </div>
                <button type="button" class="btn btn-primary fw-bold px-4 py-2 mt-5 mb-5">See More Courses</button>
            </div>
        </section>
    </main>
    <?php require 'footer.php'; ?>
    <!-- Bootstrap Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>