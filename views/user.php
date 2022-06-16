<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card text-left">
              <img class="card-img-top" src="<?= PUBLIC_ROOT . $user->user_img ?>" alt="">
              <div class="card-body">
                <h4 class="card-title display-3"><?= $user->user_name ?></h4>
                <p class="card-text"><?= $user->user_email ?></p>
                <p class="card-text">Money: WA <?= $user->user_money ?></p>
              </div>
            </div>
        </div>
    </div>
</div>