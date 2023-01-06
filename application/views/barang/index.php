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
		$('.bootstrap-toggle').bootstrapToggle();

		$('.bootstrap-toggle').each(function() {
			$(this).change(function() {
				const status = $(this).prop('checked');
				const id = $(this).data('id');
				console.log(id, status);
				$.ajax({
					'url': "<?= site_url('barang/updateStatus') ?>",
					'method': 'POST',
					'data': {
						id: id,
						status:status
					},
					success: function(result){
						if (result === 'success') {
							location.reload();
						}
					}
				})
			})
		})
	})

	$(document).ready(function() {
		$('table').dataTable();
	})
</script>
