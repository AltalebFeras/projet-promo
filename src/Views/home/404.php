	<?php include_once __DIR__ . '/../includes/header.php'; ?>

	<div class="container-fluid">
		<div class="d-flex flex-column justify-content-between sidebar align-items-center p-3">
			<?php include_once __DIR__ . '/../includes/sidebar.php'; ?>
		</div>
		<div class="main">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 ">
						<div class="col-sm-10 col-sm-offset-1  text-center">
							<div class="four_zero_four_bg">
								<h1 class="text-center ">404</h1>
								<!-- div for messages -->
								<div class="my-3 successAndErrorMessage"></div>
								<!-- Input field for URL -->
								<input type="hidden" class="urlPage" value="<?= htmlspecialchars(HOME_URL . 'dashboard') ?>" />

							</div>

							<div class="contant_box_404">
								<h3 class="h2">
									Look like you're lost
								</h3>

								<p>the page you are looking for not avaible!</p>

								<a href="/" class="link_404">Go to Home</a>
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>
	<?php include_once __DIR__ . '/../includes/footer.php'; ?>