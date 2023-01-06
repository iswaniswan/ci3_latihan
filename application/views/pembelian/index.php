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
							<th scope="col">Supplier</th>
							<th scope="col">Keterangan</th>
							<th scope="col">Action</th>
							</tr>
						</thead>

						<tbody>
							<?php foreach ($allPembelian as $pembelian) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $pembelian['tanggal'] ?></td>
									<td><?= $pembelian['nama_supplier'] ?></td>
									<td><?= $pembelian['keterangan'] ?></td>
									<td>
										<div class="container">
											<a href="<?= site_url('pembelian/read/'.$pembelian['id']) ?>" class="btn btn-sm btn-success"><i class="bi-eye"></i></a>
											<a href="<?= site_url('pembelian/update/'.$pembelian['id']) ?>" class="btn btn-sm btn-warning"><i class="bi-pencil"></i></a>
											<a href="<?= site_url('pembelian/delete/'.$pembelian['id']) ?>" class="btn btn-sm btn-danger"><i class="bi-trash"></i></a>
										</div>
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
	$(document).ready(function() {
		$('table').dataTable();
	})

</script>
