<?php include __DIR__ . "/../inc/head.php" ?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php ROOT . "poll/create"?>" method="post" class="mb-3">
                <h3>Enter poll details</h3>
                <div class="form-group">
                  <label for="pName">Poll Name</label>
                  <input type="text" name="pName" id="pName" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="pDesc">Poll Description</label>
                  <textarea rows="15" type="text" name="pDesc" id="pDesc" class="form-control" placeholder="" aria-describedby="helpId"></textarea>
                </div>
                <button type="submit" class="btn btn-block btn-primary"><i class="fa fa-plus-circle" aria-hidden="true"></i> Confirm and Publish</button>
            </form>
            <a href="<?= ROOT . "poll"?>" class="btn btn-warning btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</a>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../inc/footer.php" ?>
