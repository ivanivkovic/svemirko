<?php if(!empty($breadcrumbs)):	?>

	<nav aria-label="breadcrumb">
		<ol class="breadcrumb">

			<?php foreach($breadcrumbs as $crumb ): ?>

				<li class="breadcrumb-item <?php if (!isset($crumb['link'])){echo 'active'; } ?>">
					<a <?php echo isset($crumb['link']) ? 'href="' . BASE_PATH . $crumb['link'] . '"' : '' ?>>
						<?php echo  $crumb['title'] ?>
					</a>
				</li>

			<?php endforeach; ?>

		</ol>
	</nav>

<?php endif;?>