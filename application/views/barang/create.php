<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header">
				<h5 class="card-title">
					Form Barang
				</h5>
			</div>
			<div class="card-body">
				<form method="POST" action="<?= site_url('barang/create') ?>">
					<div class="mb-3">
						<label class="form-label">Kode</label>
						<input type="text" class="form-control" name="kode">
					</div>
					<div class="mb-3">
						<label class="form-label">Nama</label>
						<input type="text" class="form-control" name="nama">
					</div>
					<div class="mb-3">
						<label class="form-label">Harga</label>
						<input type="text" class="form-control currency-input" name="harga">
					</div>
					<button type="submit" class="btn btn-primary">Submit</button>
					<a href="<?= site_url('barang/index') ?>" class="btn btn-dark">Kembali</a>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('public/libs/js/currencyFormatter.js') ?>"></script>
<script type="text/javascript">

	$(document).ready(function() {
		$("input.currency-input").each(function() {
			$(this).on({
				keyup: function() {
					FormatCurrency($(this));
				},
				blur: function() {
					FormatCurrency($(this), "blur", "Rp. ");
				}
			});
		});
	})

</script>
