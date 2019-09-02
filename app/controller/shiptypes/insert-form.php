<div class="form-group text-right">
  <button class="btn btn-primary" id="insert-form-toggle">Add New Ship Type</button>
</div>

<form class="input-group mb-4" style="display:none;" id="insert-form" action="<?php echo BASE_PATH ?>shiptypes/insert" method="POST">

  <input type="text" name="name" class="form-control" placeholder="Enter Ship Name"/>

  <div class="input-group-append">
    <button class="btn btn-outline-secondary submit" type="submit">Insert</button>
  </div>

</form>

<section id="results">
</section>