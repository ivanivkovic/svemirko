
		</div>

		<script>
			var base_url = '<?php echo BASE_PATH ?>';
		</script>
		
		<script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

		<?php if(isset($js)): foreach($js as $file): ?>
	
			<script src="<?php echo BASE_PATH . DIR_JS . $file; ?>" type="text/javascript"></script>
	
		<?php endforeach; endif; ?>

		<script src="<?php echo BASE_PATH ?>src/jquery-ui/jquery-ui.min.js"></script>

		<link rel="stylesheet" href="<?php echo BASE_PATH ?>src/jquery-ui/jquery-ui.min.css"/>
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous"/>
	</body>
</html>