<nav class="navbar navbar-expand-lg mb-5" style="background-color: #e3f2fd;">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link <?= $active == 'barang' ? 'active' : '' ?>" href="<?= site_url('barang/index') ?>">Barang</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= $active == 'supplier' ? 'active' : '' ?>" href="<?= site_url('supplier/index') ?>">Supplier</a>
				</li>
				<li class="nav-item">
					<a class="nav-link <?= $active == 'pembelian' ? 'active' : '' ?>" href="<?= site_url('pembelian/index') ?>">Pembelian</a>
				</li>
			</ul>
		</div>
	</div>
</nav>
