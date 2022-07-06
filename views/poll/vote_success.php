<?php include __DIR__ . "/../inc/head.php" ?>

<div class="container my-5 py-5">
    <div class="row">
        <div class="col-md-12">
            <h1 class="display-1">
                Your vote is recorded!
            </h1>
            <a href="<?=ROOT?>poll/get/<?=$id?>" class="btn btn5 btn-lg btn-block mb-3">Go back to curent poll</a>
            <a href="<?=ROOT?>poll" class="btn btn6 btn-lg btn-block">Vote more...</a>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../inc/footer.php" ?>
