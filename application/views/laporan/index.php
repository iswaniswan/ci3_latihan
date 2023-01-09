<div class="row mb-5">
	<div class="container">
		<div class="card">
			<div class="card-header">
				Filter Laporan
			</div>
			<div class="card-body">
				<form action="<?= site_url('laporan/generate') ?>" method="post">
					<div class="row">
						<div class="mb-3 col-6">
							<label class="form-label">Tanggal Mulai</label>
							<input type="date" class="form-control" name="tanggal_mulai" required>
						</div>
						<div class="mb-3 col-6">
							<label class="form-label">Tanggal Akhir</label>
							<input type="date" class="form-control" name="tanggal_akhir" required>
						</div>
					</div>
					<div class="mb-3">
						<label class="form-label">Supplier <small class="fst-italic text-muted">(* Opsional)</small></label>
						<select class="form-select" name="id_supplier" required>
							<option>- Pilih -</option>
							<?php foreach ($allSupplier as $supplier) { ?>
								<option value="<?= $supplier['id'] ?>"><?= $supplier['nama'] ?></option>
							<?php } ?>
						</select>
					</div>
					<div class="mb-3">
						<button type="submit" class="btn btn-primary">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('public/libs/js/instanceSubmitForm.js') ?>"></script>
<script>

	$(document).ready(function() {
		$('table').dataTable();
		$('select').select2();
	})
</script>
