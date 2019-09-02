<?php if(!empty($arrivals)): ?>

<div class="card" style="border-top:none !important;">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Type</th>
        <th scope="col">Name</th>
        <th scope="col">Time Of Arrival</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>

  	<?php foreach($arrivals as $arrival): ?>

  	    <tr>
  	      <td><?php echo $arrival['type_name'] ?></td>
  	      <td><?php echo $arrival['name'] ?></td>
  	      <td><?php echo $arrival['time'] ?></td>
          <td>
            <a 
              class="fas fa-trash-alt cancel-delete" 
              data-target="#confirm-delete"
              data-toggle="modal"
              href="<?php echo BASE_PATH . 'arrivals/delete/' . $arrival['id'] ?>"> 
            </a>
          </td>
  	    </tr>

  	<?php endforeach; ?>

    </tbody>
  </table>
</div>

  <?php if(!empty($arrival_statistics)): ?>

    <div class="card mt-4" style="border-top:none !important;">
      <table class="table">
        <thead>
          <tr>
            <th scope="col">Type</th>
            <th scope="col">Count</th>
          </tr>
        </thead>
        <tbody>

        <?php foreach($arrival_statistics as $stat): ?>

            <tr>
              <td><?php echo $stat['type_name'] ?></td>
              <td><?php echo $stat['count'] ?></td>
            </tr>

        <?php endforeach; ?>

        </tbody>
      </table>
    </div>

  <?php endif; ?>

<div id="confirm-delete" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Deletion</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure you wish to delete this entry? The action cannot be undone.</p>
        </div>
        <div class="modal-footer">
          <a type="button" style="color:white" class="btn btn-primary btn-ok">Yes, Delete</a>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<?php endif; ?>
