<?php include __DIR__ . "/../inc/head.php" ?>
<?php if($_SESSION['logged_in']): ?>
<?php include "views/inc/error.php" ?>
<div class="container my-5 pt-5">
  <?php include "views/inc/error.php" ?>
    <div class="row">
        <div class="col-md-12">
            <form action="<?php ROOT . "poll/create"?>" method="post" class="mb-3" enctype="multipart/form-data">
                <h3 class="display-3">Enter poll details</h3>
                <div class="form-group">
                  <label for="pTitle">Poll Title</label>
                  <input type="text" name="pTitle" id="pTitle" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="pDesc">Poll Description</label>
                  <textarea rows="5" type="text" name="pDesc" id="pDesc" class="form-control" placeholder="" aria-describedby="helpId"></textarea>
                </div>
                <div class="form-group">
                  <label for="pOption1">Option 1</label>
                  <input type="text" name="pOption1" id="pOption1" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="pOption2">Option 2</label>
                  <input type="text" name="pOption2" id="pOption2" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="img">Image (optional)</label>
                  <input type="file" name="img">
                  <div class="invalid-feedback">
                    Image invalid
                  </div>
                </div>
                <?php CSRF::outputToken(); ?>
                <button type="submit" class="btn btn6 btn-block"><i class="fa fa-plus-circle" aria-hidden="true"></i> Confirm and Publish</button>
            </form>
            <a href="<?= ROOT . "poll?page=0"?>" class="btn btn4 btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back to Polls</a>
        </div>
    </div>
</div>
<?php else: ?>
Cant access
<?php endif; ?>

<?php include __DIR__ . "/../inc/footer.php" ?>
