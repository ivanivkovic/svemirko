<form class="input-group mb-4" id="form-element" action="<?php echo BASE_PATH ?>arrivals/list" method="POST">

  <select class="custom-select" id="ship-type-select">
    <option selected value='0'>Choose Ship Type...</option>

    <?php foreach($ship_types as $type): ?>

      <option value="<?php echo $type['id'];?>">

        <?php echo $type['name']; ?>

      </option>

    <?php endforeach; ?>

  </select>

  <input type="text" class="form-control" id="ship-name" placeholder="Enter Ship Name"/>

  <div class="input-group-append">
    <button class="btn btn-outline-secondary" type="submit" id="form-submit">Search</button>
  </div>
</form>

<section id="search-results">
</section>