<?php include "inc/head.php" ?>
<div class="container">
    <div class="jumbotron mt-4">
        <h1 class="display-3">Welcome to our Poll App</h1>
        <p class="lead">Jumbo helper text</p>
        <hr class="my-2">
        <p>More info</p>
        <p class="lead">
            <?php if($_SESSION['logged_in']): ?>
            <a class="btn btn-primary btn-lg" href="<?=ROOT?>poll/create" role="button">Create your new poll</a>
            <?php else: ?>
            <a class="btn btn-primary btn-lg" href="<?=ROOT?>login" role="button">Login to create your first poll</a> 
            <?php endif; ?>
        </p>
    </div>
</div>
<?php include "inc/footer.php" ?>