<?php include('../../config.php'); ?>
<?php include('../../head.php'); ?>
<?php
// Mendapatkan segmen URL setelah 'localhost/lat'
$url_segments = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
$current_segment = isset($url_segments[2]) ? $url_segments[2] : ''; // Ini akan memberikan 'siswa' jika URL adalah 'localhost/lat/view/siswa/index.php'
?>


<body>
	<!-- Layout wrapper -->
	<div class="layout-wrapper layout-content-navbar">
		<div class="layout-container">

			<!-- Menu -->
			<?php include('../../side.php'); ?>
			<!-- / Menu -->

			<!-- Layout container -->
			<div class="layout-page">

				<!-- Navbar -->
				<?php include('../../navbar.php'); ?>
				<!-- / Navbar -->

				<!-- Content wrapper -->
				<div class="content-wrapper">

					<!-- Content -->
					<h1>DATA GURU</h1>
					<!-- / Content -->

					<!-- Footer -->
					<?php include('../../footer.php'); ?>
					<!-- / Footer -->

					<div class="content-backdrop fade"></div>
				</div>
				<!-- Content wrapper -->
			</div>
			<!-- / Layout page -->
		</div>

		<!-- Overlay -->
		<div class="layout-overlay layout-menu-toggle"></div>
	</div>
	<!-- / Layout wrapper -->


	<!-- Core JS -->
	<!-- build:js assets/vendor/js/core.js -->
	<script src="<?php echo $base_url; ?>assets/vendor/libs/jquery/jquery.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/libs/popper/popper.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/js/bootstrap.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/libs/node-waves/node-waves.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/js/menu.js"></script>

	<!-- endbuild -->

	<!-- Vendors JS -->

	<!-- Main JS -->
	<script src="<?php echo $base_url; ?>assets/js/main.js"></script>

	<!-- Page JS -->

	<!-- Place this tag before closing body tag for github widget button. -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>