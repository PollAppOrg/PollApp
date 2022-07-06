<?php include "inc/head.php" ?>
<div class="container mt-5 pt-2">
    <div class="row my-5">
        <div class="col-md-6">
          <img class="card-img-top" src="<?= PUBLIC_ROOT . $user->user['img'] ?>" alt="">
        </div>
        <div class="col-md-6">
          <div class="card text-left h-100 border-0">   
              <div class="card-body d-flex flex-column">
                <h4 class="card-title display-3"><?= $user->user['username'] ?></h4>
                <p class="card-text"><?= $user->user['email'] ?></p>
              </div>
            </div>
        </div>
    </div>
</div>
<?php include "inc/footer.php" ?>
