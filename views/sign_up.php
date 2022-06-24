<?php include "inc/head.php" ?>
<div class="container my-5">
    <?php if($_SESSION["logged_in"] === false): ?>

    <?php include "views/inc/error.php" ?>
    <div class="row">
    <div class="col-md-6 pr-5 offset-md-3">
        <h3 class="font-weight-light d-flex justify-content-center">Create Account</h3>
        <hr>
        <form action="<?=ROOT?>user/create" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" class="form-control"  placeholder="Enter a username..." name="username" value="">
                <div class="invalid-feedback">
                Username invalid! 
                </div>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control"  placeholder="Enter your email..." name="email" value="">
                <div class="invalid-feedback">
                Email invalid
                </div>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control"  placeholder="Enter a password" name="password">
                <div class="invalid-feedback">
                Password invalid!
                </div>
            </div>
            <div class="form-group">
                <label for="password_confirm">Confirm Password</label>
                <input type="password" class="form-control"  placeholder="Confirm password..." name="password_confirm">
                <div class="invalid-feedback">
                Passwords don't match!
                </div>
            </div>
            <div class="form-group">
                <label for="img">Image (optional)</label>
                <input type="file" name="img">
                <div class="invalid-feedback">
                Image invalid
                </div>
            </div>
            <?php CSRF::outputToken(); ?>
            <button class="btn btn-primary btn-block" type="submit" name="create" value="true"><i class="fa-solid fa-circle-plus mr-2"></i>Create Account</button>
        </form>
        </div>
    </div>
    <?php else: ?>
    You are already logged in!
    <?php endif ?>
</div>
<?php include "inc/footer.php" ?>
