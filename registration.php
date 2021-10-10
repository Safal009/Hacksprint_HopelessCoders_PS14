<?php

session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Create account</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

    <!-- Bootstrap CSS -->
    <link
      rel="stylesheet"
      href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
      integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb"
      crossorigin="anonymous"
    />
  </head>
  <body>
<?php

include "dbcon.php";

if(isset($_POST['submit'])){
    $firstname =  mysqli_real_escape_string($con , $_POST['firstname']);
    $lastname =  mysqli_real_escape_string($con, $_POST['lastname']);
    $email =  mysqli_real_escape_string($con , $_POST['email']);
    $password =  mysqli_real_escape_string($con, $_POST['password']);
    $cpassword =  mysqli_real_escape_string($con, $_POST['cpassword']);


    $pass = password_hash($password, PASSWORD_BCRYPT);
    $cpass = password_hash($cpassword, PASSWORD_BCRYPT);

    $emailquery = " select * from registration where email = '$email' ";
    $query = mysqli_query($con, $emailquery);
    $emailcount = mysqli_num_rows($query);

    if($emailcount>0){
        ?>

        <script>
            alert("Email exists")
        </script>
    
        <?php
    }
    else{
        if($password == $cpassword){
            $insertquery = "insert into registration(firstname, lastname, email, password, cpassword) values('$firstname', '$lastname', '$email', '$pass', '$cpass')";
            $_SESSION['firstname'] = $firstname;
            header('location:index.php');
        }
            
        }

        if($password != $cpassword){
            ?>

            <script>
                alert("Please try again")
            </script>
        
            <?php
           
        }



    // mysqli_real_escape_string()
    
}





?>




    <div class="jumbotron jumbotron-fluid">
      <div class="container">
        <div class="row">
          <div
            class="col-12 col-sm-8 col-md-6 col-lg-4 offset-sm-2 offset-md-3 offset-lg-4"
          >
            <h1 class="mb-3 text-center">Wheels R'Us</h1>
            <p class="lead">

            </p>
            <form  action="" method="POST">
              <div class="row">
                <div class="form-group col-12 col-sm-6">
                  <label for="firstName">First name:</label>
                  <input
                    type="text"
                    name = "firstname"
                    class="form-control"
                    placeholder="First name"
                    id="firstName"
                    required
                  />
                </div>
                <div class="form-group col-12 col-sm-6">
                  <label for="lastName">Last name:</label>
                  <input
                    type="text"
                    name = "lastname"
                    class="form-control"
                    placeholder="Last name"
                    id="lastName"
                    required
                  />
                </div>
              </div>
              <div class="form-group">
                <label for="email">Email:</label>
                <input
                  type="email"
                  class="form-control"
                  placeholder="example@example.com"
                  name = "email"
                  id="email"
                  required
                />
              </div>
              <div class="form-group">
                <label for="password">Password:</label>
                <input
                  type="password"
                  name = "password"
                  class="form-control"
                  id="password"
                  required
                />
              </div>
              <div class="form-group">
                <label for="password"> Repeat Password:</label>
                <input
                  type="password"
                  class="form-control"
                  name = "cpassword"
                  id="password"
                  required
                />
              </div>
              <button type="submit" name = "submit" class="btn btn-primary btn-block mb-3">
                Create account
              </button>
              <div class="alert alert-info small" role="alert">
                By clicking above you agree to our
                <a href="#" class="alert-link">Terms &amp; Conditions</a> and
                our <a href="#" class="alert-link">Privacy Policy</a>.
              </div>
              <div class="text-center">
                <p>or ...</p>
                <a href="login.php" class="btn btn-success">Login</a>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- Optional JavaScript -->
    <script
      src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
      integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
      integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh"
      crossorigin="anonymous"
    ></script>
    <script
      src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
      integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ"
      crossorigin="anonymous"
    ></script>
  </body>
</html>
