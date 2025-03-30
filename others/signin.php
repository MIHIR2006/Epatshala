<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>

    <style>
        #sign-up .container img{
          display: block;
          margin-left: auto;
          margin-right: auto;
        }

        #sign-up .container {
          border: 1px solid lightgray;
          border-radius: 5px;
          width: 77%;
          padding-top: 30px;
          padding-bottom: 30px;
          margin-bottom: 50px;
          box-shadow: 2px 2px 5px 5px #e7e6e6;
        }

        #sign-up .container form input,
        #sign-up .container form select{
          width: 70%;
          font-size: 20px;
          height: 50px;
          margin: 30px 0px 0px 0px;
          display: block;
          margin-left: auto;
          margin-right: auto;
          border: 1px solid lightgray;
          padding-left: 10px;
          border-radius: 5px;
        }

        #sign-up .container form .check{
          margin: 40px 0px 0px 160px;
          width: 2%;
        }

       #sign-up .container form a{
          margin-left: 47%;
          font-size: 18px;
        }

        #sign-up .container form button{
          width: 20%;
          font-size: 22px;
          border-radius: 10px;
          padding: 20px 0px 20px 0px; 
          margin-top: 10px;
          color: white;
        }

        #sign-up .container form .reg-group{
          text-align: center;
          margin-top: 30px;
        }
    </style>
    
</head>
<body>

<?php require 'header.php'; ?>

<section id="sign-up">

        <div class="container">

                <img src="<?php echo base_url; ?>images/logo.png">

                <form method="post" action="<?php echo base_url; ?>DB/sign_in_process.php">

                    <input type="email" placeholder="Email" name="email" required>

                    <input type="password" placeholder="Password" name="password" required="">

                    <div class="reg-group">

                        <button class="submit" type="submit" style="background-color: rgb(51, 58, 65);">Submit</button>

                    </div>

                </form>

            <a href="<?php echo base_url; ?>others/signup.php"><b>Click here for sign up<b></a>

        </div>
        
    </section>

<?php require 'footer.php'; ?>

</body>
</html>