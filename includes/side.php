<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
	<div class="app-brand demo">
		<a href="<?php echo $base_url; ?>" class="app-brand-link">
			<img src="<?php echo $base_url; ?>assets/img/logo/logo.png" style="width: 24px; height: 24px; object-fit: contain;">
			<span class="app-brand-text demo menu-text fw-semibold ms-2">AL-Hawari</span>
		</a>


		<a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
			<i class="menu-toggle-icon d-xl-block align-middle"></i>
		</a>
	</div>

	<div class="menu-inner-shadow"></div>
	<ul class="menu-inner py-1">
		<!-- Dashboards -->
		<!-- Looping Header  Menu -->
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons ri-home-smile-line"></i>
				<div data-i18n="Dashboards">Dashboards</div>
				<div class="badge bg-danger rounded-pill ms-auto">5</div>
			</a>
			<!-- Looping sub menu -->
			<ul class="menu-sub">
				<li class="menu-item">
					<a
						href="<?php echo $base_url; ?>analisis"
						target="_blank"
						class="menu-link">
						<div data-i18n="CRM">Analisis Data</div>
						<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
					</a>
				</li>
				<li class="menu-item">
					<a href="<?php echo $base_url; ?>absensi" class="menu-link">
						<div data-i18n="Analytics">Absensi</div>
					</a>
				</li>
			</ul>
		</li>

		<!-- Layouts -->
		<li class="menu-item active open">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons ri-layout-2-line"></i>
				<div data-i18n="Layouts">Data Master</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item <?php echo ($current_segment == 'siswa') ? 'active' : ''; ?>">
					<a href="<?php echo $base_url; ?>view/siswa/index.php" class="menu-link">
						<div data-i18n="siswa">Data Siswa</div>
					</a>
				</li>
				<li class="menu-item <?php echo ($current_segment == 'guru') ? 'active' : ''; ?>">
					<a href="<?php echo $base_url; ?>view/guru/index.php" class="menu-link">
						<div data-i18n="guru">Data Guru</div>
					</a>
				</li>
				<li class="menu-item <?php echo ($current_segment == 'kelas') ? 'active' : ''; ?>">
					<a href="<?php echo $base_url; ?>view/kelas/index.php" class="menu-link">
						<div data-i18n="kelas">Data Kelas</div>
					</a>
				</li>
				<li class="menu-item <?php echo ($current_segment == 'pelajaran') ? 'active' : ''; ?>">
					<a href="<?php echo $base_url; ?>view/pelajaran/index.php" class="menu-link">
						<div data-i18n="pelajaran">Pelajaran</div>
					</a>
				</li>
			</ul>
		</li>

		<!-- Front Pages -->
		<li class="menu-item">
			<a href="javascript:void(0);" class="menu-link menu-toggle">
				<i class="menu-icon tf-icons ri-file-copy-line"></i>
				<div data-i18n="Front Pages">Transaksi</div>
			</a>
			<ul class="menu-sub">
				<li class="menu-item">
					<a
						href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/landing-page.html"
						class="menu-link"
						target="_blank">
						<div data-i18n="Landing">Nilai Siswa</div>
					</a>
				</li>
				<li class="menu-item">
					<a
						href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/front-pages/pricing-page.html"
						class="menu-link"
						target="_blank">
						<div data-i18n="Pricing">Absensi Siswa</div>
					</a>
				</li>

			</ul>
		</li>

		<li class="menu-header mt-7">
			<span class="menu-header-text">Laporan &amp; Data</span>
		</li>
		<!-- Apps -->
		<li class="menu-item">
			<a
				href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-email.html"
				target="_blank"
				class="menu-link">
				<i class="menu-icon tf-icons ri-mail-open-line"></i>
				<div data-i18n="Email">Lap. Data Siswa</div>
				<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
			</a>
		</li>
		<li class="menu-item">
			<a
				href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-chat.html"
				target="_blank"
				class="menu-link">
				<i class="menu-icon tf-icons ri-wechat-line"></i>
				<div data-i18n="Chat">Lap. Data Abses</div>
				<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
			</a>
		</li>
		<li class="menu-item">
			<a
				href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template/app-chat.html"
				target="_blank"
				class="menu-link">
				<i class="menu-icon tf-icons ri-wechat-line"></i>
				<div data-i18n="Chat">Lap. Data Nilai</div>
				<div class="badge bg-label-primary fs-tiny rounded-pill ms-auto">Pro</div>
			</a>
		</li>


		<!-- Misc -->
		<li class="menu-header mt-7"><span class="menu-header-text">Misc</span></li>
		<li class="menu-item">
			<a
				href="https://github.com/themeselection/materio-bootstrap-html-admin-template-free/issues"
				target="_blank"
				class="menu-link">
				<i class="menu-icon tf-icons ri-lifebuoy-line"></i>
				<div data-i18n="Support">Support</div>
			</a>
		</li>
		<li class="menu-item">
			<a
				href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/"
				target="_blank"
				class="menu-link">
				<i class="menu-icon tf-icons ri-article-line"></i>
				<div data-i18n="Documentation">Documentation</div>
			</a>
		</li>
	</ul>
</aside>