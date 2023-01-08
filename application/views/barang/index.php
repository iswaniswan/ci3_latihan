<div class="row">
	<div class="container">
		<div class="card">
			<div class="card-header bg-light mb-2">
				<h5 class="card-title mt-2">
					Daftar Barang
				</h5>
			</div>
			<div class="card-body">
				<div class="col-12 mb-5">
					<a href="<?= site_url('barang/create') ?>" class="btn btn-primary">
						<i class="bi-plus me-2"></i>Tambah
					</a>					
				</div>
				<div class="col-12">
					<?php $no = 1; ?>
					<table class="table table-bordered table-hover pt-4">
						<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Kode</th>
							<th scope="col">Nama</th>
							<th scope="col">Harga</th>
							<th scope="col">Action</th>
							<th scope="col">Status</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($allBarang as $barang) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $barang['kode'] ?></td>
									<td><?= $barang['nama'] ?></td>
									<td><span class="format-harga"></span>Rp. <?= number_format($barang['harga'], 2, ".", ",")?></td>
									<td>
										<div class="container">
											<a href="<?= site_url('barang/read/'.$barang['id']) ?>" class="btn btn-sm btn-success"><i class="bi-eye"></i></a>
											<a href="<?= site_url('barang/update/'.$barang['id']) ?>" class="btn btn-sm btn-warning"><i class="bi-pencil"></i></a>												
										</div>
									</td>
									<td>
										<?php $checked = $barang['status'] == 't' ? 'checked' : ''; ?>
										<input type="checkbox" name="status"
											class="bootstrap-toggle" <?= $checked ?> 
											data-toggle="toggle" 
											data-size="small" 
											data-on="Active" 
											data-off="Inactive" 
											data-onstyle="success"
											data-id="<?= $barang['id'] ?>">
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

<script>
	$(function() {
		const instanceSubmitForm = (params) => {
			let form = $(document.createElement('form'));
			$(form).attr("action", "<?= site_url('barang/updateStatus') ?>");
			$(form).attr("method", "POST");

			let inputId = $("<input>").attr("type", "hidden").attr("name", "id").val(params?.id);
			let inputStatus = $("<input>").attr("type", "hidden").attr("name", "status").val(params?.status);
			$(form).append($(inputId));
			$(form).append($(inputStatus));
			$(document.body).append(form);
			$(form).submit();
		};

		$('.bootstrap-toggle').bootstrapToggle();

		$('.bootstrap-toggle').each(function() {
			$(this).change(function() {
				const status = $(this).prop('checked');
				const id = $(this).data('id');
				console.log(id, status);
				const params = { id: id, status: status };
				instanceSubmitForm(params);
			})
		})
	})

	$(document).ready(function() {
		$('table').dataTable();
	})
</script>
