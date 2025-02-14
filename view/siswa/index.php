<?php include('../../includes/head.php'); ?>

<?php include('../../includes/db.php'); ?>

<?php

// Funsi unutk ngecek data siswa berdasarkan ID
// http: //localhost/kesiswaan/view/siswa/index.php?aksi=del&id=1

if (isset($_GET['aksi']) && $_GET['aksi'] == 'del' && isset($_GET['id'])) {

	$id = intval($_GET['id']);

	$stmt = $conn->prepare("select * from siswa where id= ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$siswa = $result->fetch_assoc();

		// hapus photo jika asa
		if (!empty($siswa['photo']) && file_exists("uploads/img/siswa" . $siswa['photo'])) {
			unlink("uploads/img/siswa" . $siswa['photo']);
		}

		#Hapus data di tabel
		$deleteStmt = $conn->prepare("DELETE FROM siswa where id=?");
		$deleteStmt->bind_param("i", $id);
		if ($deleteStmt->execute()) {
			$error_message = "Data siswa berhasil dihapus!";
		} else {
			$error_message = "Data siswa gagal dihapus!";
		}
		$deleteStmt->close();
	} else {
		$error_message = 'Data siswa tidak ditemukan!';
	}
	$stmt->close();
}

$hasil = $conn->query("
	SELECT 
	   s.id, s.nama_siswa, 
		s.nis, 
		s.jenis_kelamin,
		s.kelas, s.photo
	FROM siswa as s
    order by s.id desc; ");
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

						<!--Tombol Edan  -->
						<div class="mb-3">
							<a href="insert.php" class="btn btn-primary"> Tambah Data </a>
							<a href="#" class="btn btn-warning"> Cetak </a>

						</div>
						<!-- Basic Bootstrap Table -->

						<div class="card">
							<h5 class="card-header">DATA SISWA</h5>

							<?php if (!empty($error_message)): ?>
								<div class="alert alert-danger alert-dismissible" role="alert">
									<?php echo htmlspecialchars($error_message); ?>
									<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
								</div>
							<?php endif; ?>

							<div class="table-responsive text-nowrap">
								<table class="table table-hover">
									<thead>
										<tr>
											<th style="width: 15px;">No.</th>
											<th>NAMA SISWA </th>
											<th>NIS</th>
											<th>P/L</th>
											<th>KELAS</th>
											<th>AKSI</th>
										</tr>
									</thead>
									<tbody class="table-border-bottom-0">
										<?php
										// $row <= id, nama_siswa, kelas, jenis_kelamin - > mulai dari baris 1, , 3									
										$no = 1;
										while ($row = $hasil->fetch_assoc()) { ?>
											<tr>
												<td>
													<?php echo $no; ?>
												</td>
												<td>
													<div class="d-flex">
														<!-- Kolom kiri: Gambar -->
														<div class="me-3">
															<?php
															// Cek apakah foto ada, jika tidak tampilkan foto default
															$photoPath = "../../uploads/img/siswa/" . $row['photo'];
															$profileUrl = "profile.php?id=" . $row['id'];

															if (file_exists($photoPath) && !empty($row['photo'])) {
																// Membungkus gambar dalam link hanya
																echo '<a href="' . $profileUrl . '" style="text-decoration: none;">' .
																	'<img src="' . $photoPath . '" alt="photo" class="d-block w-px-40 h-px-50 rounded" style="transition: 
																	transform 0.3s ease; transform: scale(1);" onmouseover="this.style.transform=\'scale(1.2)\';" 
																	onmouseout="this.style.transform=\'scale(1)\';">' .
																	'</a>';
															} else {
																echo '<i class="ri-user-line ri-22px text-danger me-4"></i>'; // Foto tidak ditemukan, tampilkan ikon default
															}
															?>
														</div>
														<div>
															<span><strong><?php echo $row['nama_siswa']; ?></strong></span><br>
															<span>NIS: <?php echo $row['nis']; ?></span><br>
															<span>Kelas: <?php echo $row['kelas']; ?></span>
														</div>
													</div>
												</td>
												<td><?php echo $row['nis'] ?></td>
												<td>
													<ul class="list-unstyled m-0 avatar-group d-flex align-items-center">
														<?php if ($row['jenis_kelamin'] == 'L') { ?>
															<li data-bs-toggle="tooltip" data-popup="tooltip-custom"
																data-bs-placement="top" class="avatar avatar-xs pull-up"
																title="Laki-Laki">
																<img src="<?php echo $base_url; ?>assets/img/avatars/5.png"
																	alt="Avatar" class="rounded-circle" />
															</li>
														<?php } else { ?>
															<li data-bs-toggle="tooltip" data-popup="tooltip-custom"
																data-bs-placement="top" class="avatar avatar-xs pull-up"
																title="Perempuan">
																<img src="<?php echo $base_url; ?>assets/img/avatars/6.png"
																	alt="Avatar" class="rounded-circle" />
															</li>
														<?php } ?>
													</ul>
												</td>
												<td><span class="badge rounded-pill bg-label-primary me-1">
														<?php echo $row['kelas'] ?>
													</span></td>
												<td>
													<div class="dropdown">
														<button type="button" class="btn p-0 dropdown-toggle hide-arrow"
															data-bs-toggle="dropdown">
															<i class="ri-more-2-line"></i>
														</button>
														<div class="dropdown-menu">
															<a class="dropdown-item" href="<?= $base_url;  ?>view/siswa/edit.php?id=<?= $row['id']; ?>">
																<i class="ri-pencil-line me-1"></i> Edit</a>

															<a class="dropdown-item" href="?aksi=del&id=<?= $row['id']; ?>"
																onclick="return conmfirmDel();">
																<i class="ri-delete-bin-6-line me-1"></i> Delete</a>
														</div>
													</div>
												</td>
											</tr>
										<?php $no++;
										}

										?>

									</tbody>
								</table>
							</div>
						</div>
						<!--/ Basic Bootstrap Table -->
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

	<script>
		function conmfirmDel() {
			return confirm("Apakah Anda yakin ingin menghapus data ini?");
		}
	</script>

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
	<script src="<?php echo $base_url; ?>assets/js/ui-modals.js"></script>

	<!-- Page JS -->

	<!-- Place this tag before closing body tag for github widget button. -->
	<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>