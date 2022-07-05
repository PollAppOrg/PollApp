<!-- Button trigger modal -->
<button type="button" class="btn btn-dark btn-block mb-3" data-toggle="modal" data-target="#exampleModalLong">
 <i class="fa fa-pencil" aria-hidden="true"></i> Edit
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form action="<?=ROOT?>poll/update" method="post">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Edit poll</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <label for="title">Poll Title</label>
          <input type="text" name="title" value="<?=
          $poll['title']; ?>" class="form-control edit-title">
          
          <label for="body" class="mt-1">Poll Description</label>
          <textarea name="desc" id="" rows="4" class="form-control edit-desc"><?= $poll['description']; ?></textarea>
          <input type="hidden" name="id" value="<?= $poll['id']; ?>" class="edit-poll-id">
        
          <label for="option1" class="mt-1">Option1</label>
          <input type="text" name="option1" value="<?=
          $poll['option_1']; ?>" class="form-control edit-title">
        
          <label for="option2" class="mt-1">Option2</label>
          <input type="text" name="option2" value="<?=
          $poll['option_2']; ?>" class="form-control edit-title">
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>  
          <?php CSRF::outputToken(); ?>  
          <button type="submit" class="btn btn-primary save-edit">Save changes</button>
        </div>
      </form>      
    </div>
  </div>
</div>

<script>
  console.log("hello");
</script>