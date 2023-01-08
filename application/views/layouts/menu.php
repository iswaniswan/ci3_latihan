<?php /** @var string $active */ ?>

<nav class="navbar navbar-expand-lg mb-3 pt-3" style="background-color: #e3f2fd; border-bottom: 1px solid #ddd;">
	<div class="container-fluid">
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse px-lg-5 px-md-4 px-sm-1" id="navbarSupportedContent">
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
			<a href="<?= site_url('auth/logout') ?>" class="btn btn-sm btn-outline-dark float-right">Logout</a>
		</div>
	</div>
</nav>

<!--alert-->
<div class="row" style="margin-top: -15px !important;">
	<?php if (@$this->session->flashdata()) {
		foreach ($this->session->flashdata() as $key => $value) { ?>
			<div class="container">
				<div class="col-12 alert alert-<?=$key?> px-lg-5 px-md-4 px-sm-1 text-center" role="alert">
					<?= $this->session->flashdata($key) ?>
				</div>
			</div>
		<?php }
	} ?>
</div>

<!--need jquery-->
<script type="text/javascript">
	$(document).ready(function () {
		setTimeout(() => {
			$('.alert').fadeOut();
		}, 1500)
	});
</script>

<!-- wrapper for content -->
<!-- end wrapper is in the footer -->
<div id="wrapper" class="mt-5 px-lg-5 px-md-4 px-sm-1 mb-5">

