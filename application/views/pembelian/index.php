<div class="row">
	<div class="container">
		<div class="card">
			<div class="card-header bg-light mb-2">
				<h5 class="card-title mt-2">
					Daftar Pembelian
				</h5>
			</div>
			<div class="card-body">
				<div class="col-12 mb-5">
					<a href="<?= site_url('pembelian/create') ?>" class="btn btn-primary">
						<i class="bi-plus me-2"></i>Tambah
					</a>
				</div>
				<div class="col-12">
					<?php $no = 1; ?>
					<table class="table table-bordered table-hover pt-4">
						<thead>
							<tr>
								<th scope="col">#</th>
								<th scope="col">Tanggal</th>
								<th scope="col">No. Dokumen</th>
								<th scope="col">Supplier</th>
								<th scope="col">Keterangan</th>
								<th scope="col">Action</th>
								<th scope="col">Status</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($allPembelian as $pembelian) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $pembelian['tanggal'] ?></td>
									<td><?= $pembelian['no_dokumen'] ?></td>
									<td><?= $pembelian['nama_supplier'] ?></td>
									<td><?= $pembelian['keterangan'] ?></td>
									<td>
										<div class="container">
											<a href="<?= site_url('pembelian/read/'.$pembelian['id']) ?>" class="btn btn-sm btn-success"><i class="bi-eye"></i></a>
											<a href="<?= site_url('pembelian/update/'.$pembelian['id']) ?>" class="btn btn-sm btn-warning"><i class="bi-pencil"></i></a>
											<a href="<?= site_url('pembelian/delete/'.$pembelian['id']) ?>" class="btn btn-sm btn-danger"><i class="bi-trash"></i></a>
										</div>
									</td>
									<td>
										<?php $disabled = 'disabled'; $onsytle = 'disabled';
											if ($pembelian['canUpdateStatus']) {
												$disabled = '';
												$onsytle = 'success';
											}
										?>
										<?php $checked = $pembelian['status'] == 't' ? 'checked' : ''; ?>
										<input type="checkbox" name="status" <?= $disabled ?>
											   class="bootstrap-toggle" <?= $checked ?>
											   data-toggle="toggle"
											   data-size="small"
											   data-on="Active"
											   data-off="Inactive"
											   data-onstyle="<?= $onsytle ?>"
											   data-id="<?= $pembelian['id'] ?>">
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<style>
	.btn-disabled, .toggle:disabled:hover {
		cursor: not-allowed !important;
	}
</style>
<script>
	const instanceSubmitForm = (params) => {
		let form = $(document.createElement('form'));
		$(form).attr("action", "<?= site_url('pembelian/updateStatus') ?>");
		$(form).attr("method", "POST");

		let inputId = $("<input>").attr("type", "hidden").attr("name", "id").val(params?.id);
		let inputStatus = $("<input>").attr("type", "hidden").attr("name", "status").val(params?.status);
		$(form).append($(inputId));
		$(form).append($(inputStatus));
		$(document.body).append(form);
		$(form).submit();
	};

	$(document).ready(function() {
		$('table').dataTable();

		$('.bootstrap-toggle').each(function() {
			$(this).change(function() {
				const status = $(this).prop('checked');
				const id = $(this).data('id');
				console.log(id, status);
				const params = { id: id, status: status };
				instanceSubmitForm(params);
			})
		});

	})

</script>
