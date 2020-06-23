
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {font-family: Arial, Helvetica, sans-serif;}

</style>

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>

<div class='container'>
<div class='row'>
<div class='col'>
<!-- Material form login -->
<div class="card">

  <h5 class="card-header info-color white-text text-center py-4">
    <strong>Sign in</strong>
  </h5>

  <!--Card content-->
  <div class="card-body px-lg-5 pt-0">

    <?php
        if(isset($_GET['requiredError'])) {
            echo '<div class="alert alert-danger mt-2" role="alert">
            Login/Password are required !
          </div>';
        }

        if(isset($_GET['credentialsError'])) {
            echo '<div class="alert alert-danger mt-2" role="alert">
            User does not exist !
          </div>';'<h3>User does not exist !</h3>';
        }
    ?>

    <!-- Form -->
    <form class="text-center" style="color: #757575;" action="script.php" method="post">

      <!-- Email -->
      <div class="md-form">
        <label for="materialLoginFormEmail">E-mail</label>
        <input type="mail" id="materialLoginFormEmail" class="form-control" name='mail' placeholder='Please provide an email' required>
      </div>

      <!-- Password -->
      <div class="md-form">
        <label for="materialLoginFormPassword">Password</label>
        <input type="password" id="materialLoginFormPassword" name='pwd' class="form-control" placeholder='The associated password' required>
      </div>

      <div class="d-flex justify-content-around">
        <div>
          <!-- Remember me -->
          <div class="form-check">
            <input type="checkbox" class="form-check-input" id="materialLoginFormRemember">
            <label class="form-check-label" for="materialLoginFormRemember">Remember me</label>
          </div>
        </div>
        <div>
          <!-- Forgot password -->
          <a href="">Forgot password?</a>
        </div>
      </div>

      <!-- Sign in button -->
      <button class="btn btn-outline-info btn-rounded btn-block my-4 waves-effect z-depth-0" type="submit">Sign in</button>

      <!-- Register -->
      <p>Not a member?
        <a href="">Register</a>
      </p>

      <!-- Social login -->
      <p>or sign in with:</p>
      <a type="button" class="btn-floating btn-fb btn-sm">
        <i class="fa fa-facebook-f"></i>
      </a>
      <a type="button" class="btn-floating btn-tw btn-sm">
        <i class="fa fa-twitter"></i>
      </a>
      <a type="button" class="btn-floating btn-li btn-sm">
        <i class="fa fa-linkedin"></i>
      </a>
      <a type="button" class="btn-floating btn-git btn-sm">
        <i class="fa fa-github"></i>
      </a>

    </form>
    <!-- Form -->

  </div>

</div>
</div>
</div>
</div>
<!-- Material form login -->

</body>
</html>


