<?php include "inc/head.php" ?>

<!-- <div id = "videoOuter"> -->
<video autoplay muted loop id="myVideo">
    <source src="<?= ROOT . "public/images/UKParliament.mp4" ?>" type="video/mp4">
</video>
<!-- </div> -->

<div class="primary-color container-fluid">
    <div class="row home d-flex align-items-center">
        <div class="col-12">
            <div class="jumbotron primary-color text-white">      
            <h1 class="display-1">Welcome to our Poll App</h1>
            <p class="lead">Made by QA, TK and PT</p>
            <hr class="my-2">
            <p class="lead">
                <?php if($_SESSION['logged_in']): ?>
                    <a class="btn btn1 btn-lg mr-3 mt-3" href="<?=ROOT?>poll/create" role="button">Create your new poll</a>
                    <a class="btn btn2 btn-lg mt-3" href="<?= ROOT . "poll?page=0"?>" role="button">Vote now!</a>
                <?php else: ?>
                    <a class="btn btn1 btn-lg" href="<?=ROOT?>user/login" role="button">Login to create your first poll</a> 
                    <?php endif; ?>
                </p> 
            </div> 

        </div>
    </div>
</div>
<div class="container-fluid py-5 px-5">
    <div class="row my-5">
        <?php if($_SESSION['logged_in']): ?>
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-bars-progress display-3"></i>
                    <h3 class="card-title my-5">View Our Polls</h3>
                    <p class="card-text"></p>
                    <a href="<?= ROOT . "poll?page=0"?>" class="btn btn3 btn-block btn-lg">Leggo</a>
                </div>
            </div>
        </div>    
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <i class="fa fa-plus-circle display-3" aria-hidden="true"></i>
                    <h3 class="card-title my-5">Create New Poll</h3>
                    <p class="card-text"></p>
                    <a href="<?= ROOT . 'poll/create'?>" class="btn btn3 btn-block btn-lg">Create Now</a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card border-0">
                <div class="card-body text-center">
                    <i class="fa fa-user-circle display-3" aria-hidden="true"></i>
                    <h3 class="card-title my-5">View Your Profile</h3>
                    <p class="card-text"></p>
                    <a href="<?= ROOT . 'user'?>" class="btn btn3 btn-block btn-lg">View</a>
                </div>
            </div>
        </div>
        <?php else: ?>
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body text-center">
                    <i class="fa-solid fa-bars-progress display-3"></i>
                    <h3 class="card-title my-5">View Our Polls</h3>
                    <p class="card-text"></p>
                    <a href="<?= ROOT . "poll?page=0"?>" class="btn btn3 btn-block btn-lg">Leggo</a>
                </div>
            </div>
        </div>    
        <div class="col-md-6">
            <div class="card border-0">
                <div class="card-body text-center">
                    <i class="fa fa-arrow-circle-right display-3" aria-hidden="true"></i>
                    <h3 class="card-title my-5">Log In Now</h3>
                    <p class="card-text"></p>
                    <a href="<?= ROOT . 'user/login'?>" class="btn btn3 btn-block btn-lg">Login</a>
                </div>
            </div>
        </div>    
        <?php endif; ?>
    </div>
</div>

<div class="container-fluid mb-5 pb-5">
    <h3 class="display-3 text-center mb-5">Top Trending Polls</h3>
    <div class="row">
        <div class="col-12">
            <ul class="list-group top-trending">
                <li class="list-group-item d-flex justify-content-between border-top-0 border-left-0 border-right-0">
                    <h4 class="index">#</h4>
                    <h4 class="title">Title</h4>
                    <h4 class="vote">Votes</h4>
                    <h4 class="link">Go to Poll</h4>
                </li>
            </ul>
        </div>
    </div>
</div>


<div class="row hero1">
    
</div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    root = "<?= ROOT ?>"
    <?php include 'js/main.js'; ?>
</script>


<?php include "inc/footer.php" ?>