<?php if(!empty($ship_types)): ?>

<div class="card" style="border-top:none !important;">
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Id</th>
        <th scope="col">Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>

  	<?php foreach($ship_types as $ship_type): ?>

  	    <tr>
  	      <td><?php echo $ship_type['id'] ?></td>
  	      <td><?php echo $ship_type['name'] ?></td>
          <td>
            <a 
              class="fas fa-trash-alt cancel-delete" 
              data-target="#confirm-delete"
              data-toggle="modal"
              href="<?php echo BASE_PATH . 'shiptypes/delete/' . $ship_type['id'] ?>"> 
            </a>
          </td>
  	    </tr>

  	<?php endforeach; ?>

    </tbody>
  </table>
</div>


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