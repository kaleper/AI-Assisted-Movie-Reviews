<link rel="stylesheet" href="app/views/css/sign_up.css">
<?php require_once 'app/views/templates/headerAnon.php'?>

<?php
  // Displays username taken message if user tries to register with a taken username
  if ($_SESSION['taken_username_message']) {
    echo "<div class='container text-center'>" .
            "<div class='col-lg-12 mt-5'>".
              "<h5 class = 'text-danger'><br>" .
                $_SESSION['taken_username_message'] .
              "</h5>" .
            "</div>" .
         "</div>"
    ;

    // Unset session variable to display message only once 
    unset($_SESSION['taken_username_message']);
  }; 
?>

<main>
  <div class="form row justify-content-center">
    <div class="col-12 col-sm-8 col-md-6 col-xl-4">
      <div class="form-container text-center mt-5 mb-3 px-5 py-5">
        <form action="/sign_up/newAcc" method="post" >
          <h1 class="header h2 fw-normal">Register</h1>
          <fieldset class="container mt-4">
            <div class="form-group mb-1">
              <label class="visually-hidden">Username</label>
              <!-- Uses regular expression, username must have at least 3 characters -->
              <input type="text" class="form-control" name="username" placeholder="Username" pattern=".{3,}" required autofocus>
            </div>
            <div class="username-requirement text-start ms-1">Must contain 3 characters
            </div>
            <div class="form-group mt-3">
              <label class="visually-hidden">Password </label>
              <!-- Uses regular expression, password must have at least one number, one uppercase and lowercase letter, one symbol and a length of 8 characters -->
              <input type="password" class="form-control" name="password" placeholder="Password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^\w\d\s]).{8,}" required autofocus>  
              <div class="password-requirement text-start ms-1" >Must contain 8 characters, 1 uppercase and lowercase letter, 1 symbol and 1 number
              </div>
              <div class= "button mt-4">
                <button type="submit" class="btn btn-primary">Create Account</button>
                <div class="sign-up mt-4"> Already have an account?
                  <span>
                    <a class=link href="/login">Login now</a> 
                  </span>
                </div>
              </div>
            </div>
          </fieldset>
        </form> 
      </div>
    </div>
  </div>
</main>

<?php require_once 'app/views/templates/footer.php' ?>