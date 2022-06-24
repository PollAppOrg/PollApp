<?php include __DIR__ . "/../inc/head.php" ?>
<?php if($_SESSION['logged_in']): ?>
<div class="container my-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="display-3">
                <?= $poll['title'] ?>
            </h3>
            <p><?= $poll['description'] ?></p>
            <p class="text-muted"><?= $poll['username'] ?> | <?= date("d-M-Y", strtotime($poll['date_created'])) ?> </p>
            
            
            <?php if($poll['author_id'] != $_SESSION['user_id']): ?>
            <div class="d-flex align-items-center">
                <div class="div w-100 mr-3 text-center">
                    <strong><?= $poll['option_1'] ?></strong>
                    <form action="<?=ROOT?>poll/vote" method="post">
                        <input type="hidden" name="id" value="<?=$poll['id']?>">
                        <input type="hidden" name="option" value="1">
                        <?php CSRF::outputToken(); ?>
                        <button type="submit" class="btn btn-success btn-block">Option1</button>
                    </form>
                   
                </div>
                <div class="div w-100 text-center">
                    <strong><?= $poll['option_2'] ?></strong>
                    <form action="<?=ROOT?>poll/vote" method="post">
                        <input type="hidden" name="id" value="<?=$poll['id']?>">
                        <input type="hidden" name="option" value="2">
                        <?php CSRF::outputToken(); ?>
                        <button class="btn btn-warning btn-block mt-0">Option2</button>
                    </form>
                </div>
            </div>
            <?php else: ?>
                <form action="<?= ROOT?>poll/delete" method='post'>
                    <input type="hidden" name="id" value="<?php echo $poll['id'];?>">
                    <?php CSRF::outputToken(); ?>
                    <button type="submit" class="btn btn-danger btn-block mb-3"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                </form>
            <?php endif; ?>
            <a href="<?= ROOT . "poll"?>" class="btn btn-warning btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
    </div>
</div>
<?php else: ?>
<?php endif; ?>

<?php include __DIR__ . "/../inc/footer.php" ?>
