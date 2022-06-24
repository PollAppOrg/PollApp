<?php if(!empty($errors)): ?>
    <div class="alert alert-danger">
        <h3>Errors</h3>
        <?php foreach($errors as $errors): ?>
            <div>
                <p><?= $errors?></p>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>