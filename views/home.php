<?php include "inc/head.php" ?>
<div class="home d-flex align-items-center justify-content-center">
    <canvas id="myChart" style="position: fixed; height:100vh; width:100vw"></canvas>
    <div class="jumbotron opacity">
                
        <h1 class="display-3">Welcome to our Poll App</h1>
        <p class="lead">Made by QA TK and PT</p>
        <hr class="my-2">
        <p class="lead">
            <?php if($_SESSION['logged_in']): ?>
                <a class="btn btn-primary btn-lg mr-3 mt-3" href="<?=ROOT?>poll/create" role="button">Create your new poll</a>
                <a class="btn btn-warning btn-lg mt-3" href="<?=ROOT?>poll" role="button">Vote now!</a>
                <?php else: ?>
                    <a class="btn btn-primary btn-lg" href="<?=ROOT?>user/login" role="button">Login to create your first poll</a> 
                    <?php endif; ?>
                </p>
            </div>
        </div> 
</body>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js" integrity="sha512-sW/w8s4RWTdFFSduOTGtk4isV1+190E/GghVffMA9XczdJ2MDzSzLEubKAs5h0wzgSJOQTRYyaz73L3d6RtJSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    <?php include 'js/chartGenerate.js'; ?>
</script>


<?php include "inc/footer.php" ?>