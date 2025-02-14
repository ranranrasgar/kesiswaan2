<?php include('../../includes/head.php'); ?>
<?php include('../../includes/db.php'); ?>

<!-- Butuh perintah untuk mengambil data dari tabel siswa 
     1. Perintah SQL untuk ambil data
	 2. Perintah SQL untuk input data
	 3. Perintah SQL untuk edit data
	 4. Perintah SQL untuk hapus data -->

<!-- Perintah untukk ambil data dari tabel siswa -->
<?php
$siswa_id = isset($_GET['id']) ? $_GET['id'] : null;
// Jika ID ada, ambil data siswa berdasarkan ID tersebut
if ($siswa_id) {
    // Query untuk mengambil data siswa berdasarkan ID
    $query = "
        SELECT 
            s.id, s.nama_siswa, 
            s.nis, 
            s.jenis_kelamin,
            s.kelas, s.photo
        FROM siswa as s
        WHERE s.id = $siswa_id
    ";
    // Eksekusi query
    $hasil = $conn->query($query);
}
?>

<body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
        <div class="layout-container">

            <!-- Menu -->
            <?php include('../../includes/side.php'); ?>
            <!-- / Menu -->

            <!-- Layout container -->
            <div class="layout-page">

                <!-- Navbar -->
                <?php include('../../includes/navbar.php'); ?>
                <!-- / Navbar -->

                <!-- Content wrapper -->
                <div class="content-wrapper">

                    <!-- Content -->
                    <div class="container-xxl flex-grow-1 container-p-y">

                    </div>
                    <!-- / Content -->

                    <!-- Footer -->
                    <?php include('../../includes/footer.php'); ?>
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