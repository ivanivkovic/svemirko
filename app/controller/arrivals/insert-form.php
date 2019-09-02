<div class="form-group text-right">
  <button class="btn btn-primary" id="insert-form-toggle">Add New Arrival</button>
</div>

<form class="input-group mb-4" style="display:none;" id="insert-form" action="<?php echo BASE_PATH ?>arrivals/insert" method="POST">

  <select class="custom-select" name="type_id">
    <option value='0'>Choose Ship Type...</option>

    <?php foreach($ship_types as $type): ?>

      <option value="<?php echo $type['id'];?>" <?php if(isset($type_id) && $type_id == $type['id']): echo 'selected'; endif; ?>>

        <?php echo $type['name']; ?>

      </option>

    <?php endforeach; ?>

  </select>

  <input type="text" name="name" class="form-control" placeholder="Enter Ship Name"/>

  <div class="input-group-append">
    <button class="btn btn-outline-secondary submit" type="submit">Insert</button>
  </div>

</form>

<section id="results">
</section>