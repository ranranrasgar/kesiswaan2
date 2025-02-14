<?php
// Sertakan file konfigurasi
include('config.php');
?>

<!doctype html>

<html
	lang="en"
	class="light-style layout-menu-fixed layout-compact"
	dir="ltr"
	data-theme="theme-default"
	data-assets-path="<?php echo $base_url; ?>"
	data-template="vertical-menu-template-free"
	data-style="light">

<head>
	<meta charset="utf-8" />
	<meta
		name="viewport"
		content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

	<title>Kesiswaan</title>

	<meta name="description" content="" />

	<!-- Favicon -->
	<link rel="icon" type="image/x-icon" href="<?php echo $base_url; ?>assets/img/logo/logo.png" />

	<!-- Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com" />
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
	<link
		href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&ampdisplay=swap"
		rel="stylesheet" />

	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/vendor/fonts/remixicon/remixicon.css" />

	<!-- Menu waves for no-customizer fix -->
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/vendor/libs/node-waves/node-waves.css" />

	<!-- Core CSS -->
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/vendor/css/core.css" class="template-customizer-core-css" />
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/css/demo.css" />

	<!-- Vendors CSS -->
	<link rel="stylesheet" href="<?php echo $base_url; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

	<!-- Page CSS -->

	<!-- Helpers -->
	<script src="<?php echo $base_url; ?>assets/vendor/js/helpers.js"></script>
	<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
	<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
	<script src="<?php echo $base_url; ?>assets/js/config.js"></script>
</head>