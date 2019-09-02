<div class="card">
	<div class="card-body">
		<form action="<?php echo BASE_PATH ?>login" method="POST">
			<div class="form-group">
				<label for="email">Email address</label>
				<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email"/>
			</div>
			<div class="form-group">
				<label for="exampleInputPassword1">Password</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" minlength="6"/>
			</div>
			<button type="submit" class="btn btn-primary">Log In</button>
		</form>
  	</div>
</div>