<?php require_once 'app/views/templates/headerPublic.php' ?>
  
  <main>
    <div class="form row justify-content-center">
      <div class="col-12 col-sm-8 col-md-6 col-xl-4">
        <div class="form-container text-center mt-5 mb-3 px-5 py-5">
          <form action="/login/verify" method="post">
            <h1 class="header h2 fw-normal">Sign In</h1>
            <fieldset class="container mt-4">
              <div class="form-group mb-1">
                <label class="visually-hidden">Username</label>
                <input type="text" class="form-control" placeholder="Username" name="username" required autofocus>
              </div>
              <div class="form-group mt-2">
                <label class="visually-hidden" >Password </label>
                <input type="password" class="form-control" placeholder="Password" name="password" required autofocus>
              </div>
              <div class="button mt-3">
                <button type="submit" class="btn btn-primary">Login</button>
              </div>
                <div class="sign-up mt-4"> New here?
                  <span>
                    <a class=link href="/sign_up">Sign Up</a> 
                  </span>
                </div>
            </fieldset>
          </form> 
        </div>
      </div>
    </div>
  </main>

<?php require_once 'app/views/templates/footer.php' ?>