<div class="row mb-5">
	<ul class="nav justify-content-end">
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