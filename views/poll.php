<?php include "inc/head.php"; ?>

<div class="container my-5">
    <h2 class="display-3">Polls</h2>
    <?php if($_SESSION['logged_in']): ?>
    <a href="<?=ROOT?>poll/create" class="btn btn-warning btn-block btn-lg"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create New Poll</a>
    <?php endif; ?>
    <?php if(!empty($polls)): ?>
        <div class="row mt-3">
            <?php foreach($polls as $poll): ?>
                <div class="col-md-4 mb-3 d-flex">
                    <div class="card text-left w-100">
                        <img class="card-img-top" src="<?= $poll['image'] ?>" alt="image"  height="150px">
                        <div class="card-body">
                            <a href=""></a>
                            <h4 class="card-title"><?= $poll['title'] ?></h4>
                            <p class="card-text"><?= $poll['description'] ?></p>
                            <p class="card-text text-muted"><?= $poll['username'] ?> | <?= date("d-M-Y", strtotime($poll['date_created'])) ?> </p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            <?php if($_SESSION['user_id'] == $poll['author_id']): ?>
                                <a class="btn btn-block btn-primary" href="poll/get/<?=$poll['id']?>">Edit</a>
                            <?php else: ?>
                                <a class="btn btn-block btn-primary" href="poll/get/<?=$poll['id']?>">Vote now!</a>
                            <?php endif; ?>
                        </div>
                    </div>    
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="display-5 text-primary">
                    There are currently no polls yet!
                </h3>
            </div>
        </div>
    <?php endif; ?>

</div>

<?php 
include "inc/footer.php" 

?>
