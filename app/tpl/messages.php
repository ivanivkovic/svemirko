<?php if(!empty($messages)): ?>	

	<?php foreach($messages as $message): ?>

		<div role="alert" class="alert alert-dismissible fade show alert-<?php echo $message['type'] ?>" role="alert">
			
			<?php echo $message['message']; ?>

			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    <span aria-hidden="true">&times;</span>
			</button>

		</div>

	<?php endforeach; ?>
	
<?php endif; ?>