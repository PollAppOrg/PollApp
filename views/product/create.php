<div class="container my-5">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php ROOT . "product/create"?>" method="post">
                <h3>Enter product details</h3>
                <div class="form-group">
                  <label for="pName">Product Name</label>
                  <input type="text" name="pName" id="pName" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
                <div class="form-group">
                  <label for="pDesc">Product Description</label>
                  <input type="text" name="pDesc" id="pDesc" class="form-control" placeholder="" aria-describedby="helpId">
                </div>
            </form>
            <a href="<?php ROOT . "product"?>" class="btn btn-warning">Back</a>
        </div>
    </div>
</div>