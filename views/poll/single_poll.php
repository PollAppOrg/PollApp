<?php include __DIR__ . "/../inc/head.php" ?>
<?php if($_SESSION['logged_in']): ?>
<?php include "views/inc/error.php" ?>
<div class="container my-5 pt-5">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <img class="card-img-top" src="<?= ROOT . $poll['image'] ?>" alt="">
            <h3 class="display-3">
                <?= $poll['title'] ?>
            </h3>
            <p><?= $poll['description'] ?></p>
            <p class="text-muted"><?= $poll['username'] ?> | <?= date("d-M-Y", strtotime($poll['date_created'])) ?> </p>
            
            <?php 
                $sum = $poll['vote_1'] + $poll['vote_2'];
                if($sum !== 0) {
                    $p1 = $poll['vote_1'] / $sum * 100;
                    $p2 = $poll['vote_2'] / $sum * 100;
                }
            ?>

            <?php if($sum != 0): ?> 
            <div class="d-flex justify-content-between">
                <p class="text-sec"><?=$poll['option_1']?>: <?=round($p1,3)?>%</p>
                <p class="text-pop2"><?=$poll['option_2']?>: <?=round($p2,3)?>%</p>
            </div>
            <div class="progress mb-3">
                <div class="progress-bar secondary-color" role="progressbar" style="width: <?=$p1?>%" aria-valuenow="<?=$p1?>" aria-valuemin="0" aria-valuemax="<?=$sum?>"></div>
                <div class="progress-bar pop-color2" role="progressbar" style="width: <?=$p2?>%" aria-valuenow="<?=$p2?>" aria-valuemin="0" aria-valuemax="<?=$sum?>"></div>
            </div>
            <?php else: ?>
                <p>There is no vote for this poll yet!</p>
            <?php endif; ?>

            <?php if($poll['author_id'] != $_SESSION['user_id']): ?>
            <div class="d-flex align-items-center mb-3">
                <div class="div w-100 mr-3 text-center">
                    <form action="<?=ROOT?>poll/vote" method="post">
                        <input type="hidden" name="id" value="<?=$poll['id']?>">
                        <input type="hidden" name="option" value="1">
                        <?php CSRF::outputToken(); ?>
                        <button type="submit" class="btn btn7 btn-block"><?= $poll['option_1'] ?></button>
                    </form>
                   
                </div>
                <div class="div w-100 text-center">
                    <form action="<?=ROOT?>poll/vote" method="post">
                        <input type="hidden" name="id" value="<?=$poll['id']?>">
                        <input type="hidden" name="option" value="2">
                        <?php CSRF::outputToken(); ?>
                        <button class="btn btn8 btn-block mt-0"><?= $poll['option_2'] ?></button>
                    </form>
                </div>
            </div>
            <?php endif; ?>

            <?php if($_SESSION['role'] == 1 || $poll['author_id'] == $_SESSION['user_id']): ?>
                <div class="d-flex mb-3 flex-column">
                    <?php include __DIR__ . "/../inc/editModal.php"?>
                    <form action="<?= ROOT?>poll/delete" method='post' class="w-100">
                        <input type="hidden" name="id" value="<?php echo $poll['id'];?>">
                        <?php CSRF::outputToken(); ?>
                        <button type="submit" class="btn btn-danger btn-block"><i class="fa fa-trash" aria-hidden="true"></i> Delete</button>
                    </form>
                </div>
            <?php endif; ?>

            <a href="<?= ROOT . "poll"?>" class="btn btn5 btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
    </div>
</div>
<?php else: ?>
<?php endif; ?>

<?php include __DIR__ . "/../inc/footer.php" ?>
