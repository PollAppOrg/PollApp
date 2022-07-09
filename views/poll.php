<?php include "inc/head.php"; 

$curPage = 0;

?>

<div class="container my-5 pt-5">
    <h2 class="display-3">Polls</h2>

    <?php if($_SESSION['logged_in']): ?>
    
    <form method="get" action="<?=ROOT . "poll/search"?>">
        <div class="form-group mb-1">
            <label for="search">Search by poll's title and author's name</label>
            <input type="text" id="search" name="value" class="form-control" placeholder="Fill in search and press ENTER" value="<?= !empty($_GET['value']) ? $_GET['value'] : '' ?>">
        </div>
        <button type="submit" class="border-0 p-0 w-0 h-0"></button>
    </form>
    
    <button class="view-trending mb-1 btn btn6 btn-block btn-lg">
        <i class="fa fa-eye" aria-hidden="true"></i>
        View Top Trending Polls
    </button>
    <div class="row">
        <div class="col-12">
            <ul class="list-group top-trending-2">
            </ul>
        </div>
    </div>

    <a href="<?=ROOT?>poll/create" class="btn btn4 btn-block btn-lg mt-4"><i class="fa fa-plus-circle" aria-hidden="true"></i> Create New Poll</a>
    <?php endif; ?>
    
    <?php if(!empty($polls)): ?>
        <ul class="pagination mt-3">
            <li class="page-item"><a class="page-link btn5" href="<?=ROOT?>poll?page=<?= $curPage > 0 ? $curPage-1 : $curPage ?>">Previous</a></li>
            <?php  
        
            for ($i=0; $i < $numofpages ; $i++) { 
                $curPage = $page;
                $page = $i+1;
                $home = ROOT."poll";
                echo "<li class='page-item'><a class='page-link btn6' href='$home?page=$i'>$page</a></li>";
            }
            ?>
            
            <li class="page-item"><a class="page-link btn5" href="<?=ROOT?>poll?page=<?= $curPage < $numofpages - 1 ? $curPage+1 : $curPage ?>">Next</a></li>
        </ul>
        <div class="row mt-4">
            <?php foreach($polls as $poll): ?>
                <div class="col-md-4 mb-4 d-flex">
                    <div class="card text-left w-100 border-pop border-top-0 border-bottom-0">
                        <img class="card-img-top" src="<?= ROOT . $poll['image'] ?>" alt="image"  height="250px">
                        <div class="card-body">
                            <a href=""></a>
                            <h3 class="card-title"><?= $poll['title'] ?></h3>
                            <p class="card-text"><?= $poll['description'] ?></p>
                            <p class="card-text text-muted"><?= $poll['username'] ?> | <?= date("d-M-Y", strtotime($poll['date_created'])) ?> </p>
                            <p class="card-text text-bold"><?= $poll['vote_1'] + $poll['vote_2'] > 1 ? $poll['vote_1'] + $poll['vote_2'] . ' people have' : $poll['vote_1'] + $poll['vote_2'] . ' person has' ?> placed their votes!</p>
                        </div>
                        <div class="card-footer p-0">
                            <?php if($_SESSION['user_id'] == $poll['author_id']): ?>
                                <a class="btn btn-block btn5 btn-lg w-100" href="<?=ROOT?>poll/get/<?=$poll['id']?>">Edit</a>
                            <?php elseif($votes->isVoted($_SESSION['user_id'],$poll['id'])): ?>
                                <a class="btn btn-block btn5 btn-lg w-100" href="<?=ROOT?>poll/get/<?=$poll['id']?>">Voted!<?= $_SESSION['role'] == 1 ? ' | Edit' : '' ?></a>
                            <?php else: ?>
                                <a class="btn btn-block btn5 btn-lg w-100" href="<?=ROOT?>poll/get/<?=$poll['id']?>">Vote now!<?= $_SESSION['role'] == 1 ? ' | Edit' : '' ?></a>
                            <?php endif; ?>
                        </div>
                    </div>    
                </div>
            <?php endforeach; ?>
            <nav aria-label="Page navigation example">
        </div>
        <ul class="pagination">
            <li class="page-item"><a class="page-link btn5" href="<?=ROOT?>poll?page=<?= $curPage > 0 ? $curPage-1 : $curPage ?>">Previous</a></li>
            <?php  
        
            for ($i=0; $i < $numofpages ; $i++) { 
                $curPage = $page;
                $page = $i+1;
                $home = ROOT."poll";
                echo "<li class='page-item'><a class='page-link btn6' href='$home?page=$i'>$page</a></li>";
            }
            ?>
            
            <li class="page-item"><a class="page-link btn5" href="<?=ROOT?>poll?page=<?= $curPage < $numofpages - 1 ? $curPage+1 : $curPage ?>">Next</a></li>
        </ul>
</nav>
    <?php else: ?>
        <div class="row">
            <div class="col-md-12">
                <h3 class="display-5 text-pop">
                    There are currently no polls yet!
                </h3>
            </div>
        </div>
    <?php endif; ?>
</div>

<script>
    let root = "<?= ROOT ?>"
    <?php include "js/main.js";?>
</script>

<?php 
include "inc/footer.php" 

?>
