<?php include "inc/head.php" ?>
<div class="container my-5">
    <?php if($_SESSION["logged_in"] === false): ?>
    <?php include "views/inc/error.php" ?>
    
    <div class="col-md-6  border-dark offset-md-3">
        <h3 class="font-weight-light d-flex justify-content-center ">Login to Account</h3>
          <hr>
        <form action="<?=ROOT?>user/login" method="post">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control"  placeholder="Enter a username..." name="username"  autocomplete="off" value="">
                <div class="invalid-feedback">
                Username invalid
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control"  placeholder="Enter a password" name="password">
                <div class="invalid-feedback">
                Password invalid!
                </div>
            </div>
            <?php CSRF::outputToken(); ?>
            <button class="btn btn-success btn-block" type="submit" name="login" value="true"><i class="fa-solid fa-circle-plus mr-2"></i>Login</button>
            <div>
                <p>Haven't got account?
                    <a href="<?=ROOT?>user/signup"> Sign up</a>
                </p>
            </div>
        </form>
    </div>
    <?php else: ?>
    You are already logged in!
    <?php endif ?>
    </div>
</div>
<?php include "inc/footer.php" ?>
