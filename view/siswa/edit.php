<?php include('../../includes/head.php'); ?>
<?php include('../../includes/db.php'); ?>
<?php


// Get data kelas
$kelasQuery = "SELECT id, nama_kelas FROM kelas ORDER BY nama_kelas ASC";
$TabelKelas = $conn->query($kelasQuery);

// Get data pekerjaan
$TabelPekerjaan = $conn->query('SELECT id, nama_pekerjaan 
		FROM pekerjaan ORDER BY nama_pekerjaan ASC');

$error_message = '';
$siswa = []; // array


// Funsi unutk ngecek data siswa berdasarkan ID
if (isset($_GET['id']) && is_numeric($_GET['id'])) {

	$id = intval($_GET['id']);
	$stmt = $conn->prepare("select * from siswa where id= ?");
	$stmt->bind_param("i", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	if ($result->num_rows > 0) {
		$siswa = $result->fetch_assoc();
		// 
	} else {
		$error_message = 'Data siswa tidak ditemukan!';
	}
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && empty($error_message)) {
	// Check if the image file is uploaded and valid
	// Validate required fields
	if (strlen($_POST['nis']) > 20) {
		$error_message = "NIS tidak boleh lebih dari 20 karakter!";
	} elseif (strlen($_POST['nama_siswa']) > 35) {
		$error_message = "Nama Siswa terlalu panjang!";
	} elseif (!in_array($_POST['jenis_kelamin'], ['L', 'P'])) {
		$error_message = "Jenis Kelamin Hanya L/P!";
	} elseif (empty($_POST['kelas'])) {
		$error_message = "Kelas harus di isi!";
	} elseif (strlen($_POST['alamat']) > 255) {
		$error_message = "Alamat terlalu panjang!";
	} elseif (strlen($_POST['hobi']) > 255) {
		$error_message = "Hobi terlalu panjang!";
	} elseif (strlen($_POST['nama_ayah']) > 100) {
		$error_message = "Nama Ayah terlalu panjang!";
	} elseif (strlen($_POST['pekerjaan_ayah']) > 100) {
		$error_message = "Pekerjaan Ayah terlalu panjang!";
	} elseif (strlen($_POST['nama_ibu']) > 100) {
		$error_message = "Nama Ibu terlalu panjang!";
	} elseif (strlen($_POST['pekerjaan_ibu']) > 100) {
		$error_message = "Pekerjaan Ibu terlalu panjang!";
	} // Validate penghasilan_ayah to be a valid number
	elseif (!is_numeric($_POST['penghasilan_ayah']) || $_POST['penghasilan_ayah'] < 0) {
		$error_message = "Penghasilan Ayah harus berupa angka yang valid!";
	}

	if (isset($_FILES['photo']) && $_FILES['photo']['error'] == 0) {

		$allowed_extensions = ['jpg', 'jpeg', 'png', 'jfif'];
		$file_extension = strtolower(pathinfo($_FILES['photo']['name'], PATHINFO_EXTENSION));

		if (!in_array($file_extension, $allowed_extensions)) {
			$error_message = "Hanya file JPG, JPEG, dan PNG yang diizinkan!";
		} elseif ($_FILES['photo']['size'] > 800000) {
			$error_message = "Ukuran file gambar maksimal 800KB!";
		} else {
			// Generate a unique name for the file
			$file_name = uniqid('photo_', true) . '.' . $file_extension;
			$file_path = '../../uploads/img/siswa/' . $file_name;

			// Move the uploaded file to the target folder
			if (!move_uploaded_file($_FILES['photo']['tmp_name'], $file_path)) {
				$error_message = "Gagal meng-upload gambar!";
			}
		}
	} else {
		$file_name = $siswa['photo']; // No file uploaded
	}

	// JIka tidak ada error
	if (empty($error_message)) {
		// Prepare SQL statement
		$stmt = $conn->prepare("UPDATE siswa SET 
        nis=?, nama_siswa=?, jenis_kelamin=?, alamat=?, kelas=?, hobi=?, nama_ayah=?, 
		pekerjaan_ayah=?, nama_ibu=?, pekerjaan_ibu=?, penghasilan_ayah=?, photo=?
		where id=? ");

		if (!$stmt) {
			$error_message = "Query gagal dipersiapkan: " . $conn->error;
		} else {
			// Directly bind POST data with the prepared statement
			$penghasilan_ayah = floatval($_POST['penghasilan_ayah']);

			$stmt->bind_param(
				"ssssssssssdsd",
				$_POST['nis'],
				$_POST['nama_siswa'],
				$_POST['jenis_kelamin'],
				$_POST['alamat'],
				$_POST['kelas'],
				$_POST['hobi'],
				$_POST['nama_ayah'],
				$_POST['pekerjaan_ayah'],
				$_POST['nama_ibu'],
				$_POST['pekerjaan_ibu'],
				$penghasilan_ayah,
				$file_name,
				$id
			);
			if (!$stmt->execute()) {
				// Display detailed error message
				$error_message = "Gagal update data: " . $stmt->error;
			} else {
				header("Location: index.php");
				exit();
			}
		}
	}
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

						<div class="row">
							<div class="col-md-12">
								<div class="nav-align-top">
									<ul class="nav nav-pills flex-column flex-md-row mb-6 gap-2 gap-lg-0">
										<li class="nav-item">
											<a class="nav-link active" href="javascript:void(0);"><i
													class="ri-group-line me-1_5"></i>Siswa</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i
													class="ri-notification-4-line me-1_5"></i>Orang Tua</a>
										</li>
										<li class="nav-item">
											<a class="nav-link" href="#"><i class="ri-link-m me-1_5"></i>Kartu
												Keluarga</a>
										</li>
									</ul>
								</div>
								<div class="card mb-6">
									<!-- Account -->
									<div class="card-body">
										<div class="d-flex align-items-start align-items-sm-center gap-6">
											<img src="<?php echo $base_url; ?>/uploads/img/siswa/<?php echo isset($siswa['photo']) && !empty($siswa['photo']) ? $siswa['photo'] : '1.png'; ?>" alt="user-avatar"
												class="d-block w-px-100 h-px-100 rounded" id="uploadedAvatar" />
											<div class="button-wrapper">
												<label for="photo" class="btn btn-sm btn-primary me-3 mb-4"
													tabindex="0">
													<span class="d-none d-sm-block">Upload new photo</span>
													<i class="ri-upload-2-line d-block d-sm-none"></i>

												</label>
												<button type="button"
													class="btn btn-sm btn-outline-danger account-image-reset mb-4">
													<i class="ri-refresh-line d-block d-sm-none"></i>
													<span class="d-none d-sm-block">Reset</span>
												</button>
												<div>Allowed JPG, GIF or PNG. Max size of 800K</div>
											</div>
										</div>
									</div>
									<div class="card-body pt-0">

										<?php if (!empty($error_message)): ?>
											<div class="alert alert-danger">
												<?php echo htmlspecialchars($error_message); ?>
											</div>
										<?php endif; ?>

										<form id="dataForm" method="POST" enctype="multipart/form-data" onsubmit="return confirmSubmit();">

											<input type="file" id="photo" name="photo" class="account-file-input" hidden
												accept="image/png, image/jpeg" />

											<div class="row mt-1 g-5">
												<div class="col-md-6">
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="nis" name="nis"
															value="<?= $siswa['nis']; ?>"
															placeholder="2024001" autofocus required />
														<label for="nis">NISN</label>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="nama_siswa"
															name="nama_siswa"
															value="<?= $siswa['nama_siswa']; ?>"
															placeholder="Abdul Rahman" autofocus required />
														<label for="nama_siswa">Nama Siswa</label>
													</div>

													<div class="form-floating form-floating-outline mb-3">
														<select class="form-select" id="jenis_kelamin" name="jenis_kelamin" required>
															<option value="">-- Pilih Jenis Kelamin --</option>
															<option value="L"
																<?php echo (isset($siswa['jenis_kelamin']) && $siswa['jenis_kelamin'] == 'L') ? 'selected' : ''; ?>>L: Laki-Laki
															</option>
															<option value="P"
																<?php echo (isset($siswa['jenis_kelamin']) && $siswa['jenis_kelamin'] == 'P') ? 'selected' : ''; ?>>P: Perempuan
															</option>
														</select>
														<label for="jenis_kelamin">Jenis Kelamin</label>
													</div>

													<div class="form-floating form-floating-outline mb-3">
														<select class="form-select" id="kelas" name="kelas" required>
															<option value="">-- Pilih Kelas --</option>
															<?php while ($row = $TabelKelas->fetch_assoc()): ?>
																<option value="<?= $row['nama_kelas']; ?>"
																	<?= (isset($siswa['kelas']) && $siswa['kelas'] == $row['nama_kelas']) ? 'selected' : ''; ?>>
																	<?= $row['nama_kelas']; ?>
																</option>
															<?php endwhile; ?>
														</select>
														<label for="kelas">Kelas</label>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="alamat"
															name="alamat"
															value="<?php echo isset($siswa['alamat']) ? htmlspecialchars($siswa['alamat']) : ''; ?>"
															placeholder="Jl. Sembarangan No. 09, Arcamanik, Bandung 40125"
															autofocus required />
														<label for="alamat">Alamat</label>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="hobi" name="hobi"
															value="<?php echo isset($siswa['hobi']) ? htmlspecialchars($siswa['hobi']) : ''; ?>"
															placeholder="Olah Raga, Membaca" autofocus />
														<label for="hobi">Hobi (Boleh lebih dari 1, pisahkan dengan
															koma)</label>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="nama_ayah"
															name="nama_ayah"
															value="<?php echo isset($siswa['nama_ayah']) ? htmlspecialchars($siswa['nama_ayah']) : ''; ?>"
															placeholder="Abdul Rahman" autofocus />
														<label for="nama_ayah">Nama Ayah</label>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<select class="form-select" id="pekerjaan_ayah" name="pekerjaan_ayah" required>
															<option value="">-- Pilih Pekerjaan --</option>
															<?php while ($row = $TabelPekerjaan->fetch_assoc()): ?>
																<option value="<?= $row['nama_pekerjaan']; ?>"
																	<?= (isset($siswa['pekerjaan_ayah']) && $siswa['pekerjaan_ayah'] == $row['nama_pekerjaan']) ? 'selected' : ''; ?>>
																	<?= $row['nama_pekerjaan']; ?>
																</option>
															<?php endwhile; ?>
															<label for="pekerjaan_ayah">Pekerjaan Ayah</label>
														</select>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="nama_ibu"
															name="nama_ibu"
															value="<?php echo isset($siswa['nama_ibu']) ? htmlspecialchars($siswa['nama_ibu']) : ''; ?>"
															placeholder="Handayani" autofocus />
														<label for="nama_ibu">Nama Ibu</label>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<select class="form-select" id="pekerjaan_ibu" name="pekerjaan_ibu" required>
															<option value="">-- Pilih Pekerjaan --</option>
															<?php
															$TabelPekerjaan->data_seek(0);
															while ($row = $TabelPekerjaan->fetch_assoc()): ?>
																<option value="<?= $row['nama_pekerjaan']; ?>"
																	<?= (isset($siswa['pekerjaan_ibu']) && $siswa['pekerjaan_ibu'] == $row['nama_pekerjaan']) ? 'selected' : ''; ?>>
																	<?= $row['nama_pekerjaan']; ?>
																</option>
															<?php endwhile; ?>
															<label for="pekerjaan_ibu">Pekerjaan Ibu</label>
														</select>
													</div>
													<div class="form-floating form-floating-outline mb-3">
														<input class="form-control" type="text" id="penghasilan_ayah"
															name="penghasilan_ayah"
															value="<?php echo isset($siswa['penghasilan_ayah']) ? htmlspecialchars($siswa['penghasilan_ayah']) : ''; ?>"
															placeholder="50.000.000,-" autofocus required />
														<label for="penghasilan_ayah">Penghasilan Ayah</label>
													</div>
												</div>

											</div>
											<div class="mt-6">
												<button type="submit" class="btn btn-primary me-3"
													id="saveButton">Simpan</button>
												<button type="reset" class="btn btn-outline-secondary">Reset</button>
											</div>
										</form>
									</div>
									<!-- /Account -->
								</div>
							</div>
						</div>
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

	<!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"> -->

	<script>
		function confirmSubmit() {
			return confirm("Apakah Anda yakin ingin menyimpan data ini?");
		}
	</script>

	<script src="<?php echo $base_url; ?>assets/vendor/libs/jquery/jquery.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/libs/popper/popper.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/js/bootstrap.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/libs/node-waves/node-waves.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
	<script src="<?php echo $base_url; ?>assets/vendor/js/menu.js"></script>
	<script src="<?php echo $base_url; ?>assets/js/pages-account-settings-account.js"></script>
	<script src="<?php echo $base_url; ?>assets/js/main.js"></script>
	<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>

</html>