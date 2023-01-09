<div class="row">
	<div class="container">
		<div class="card">
			<div class="card-header bg-light mb-2">
				<h5 class="card-title mt-2">
					Laporan
				</h5>
			</div>
			<div class="card-body">
				<div class="col-12 mb-5">
					<a href="<?= site_url('laporan/export') ?>" class="btn btn-success">
						<i class="bi-file-earmark-excel-fill me-2"></i>Export
					</a>
				</div>
				<div class="col-12">
					<?php $no = 1; ?>
					<table class="table table-bordered table-hover pt-4">
						<thead>
						<tr>
							<th scope="col" rowspan="2">#</th>
							<th scope="col" rowspan="2">Nama Supplier</th>
							<th scope="col" rowspan="2">Tanggal</th>
							<th scope="col" rowspan="2">No Dokumen</th>
							<th scope="col" colspan="2" style="text-align: center">Barang</th>
							<th scope="col" rowspan="2">Quantity</th>
							<th scope="col" rowspan="2">Harga Satuan</th>
							<th scope="col" rowspan="2">Subtotal</th>
						</tr>
						<tr>
							<th scope="col">Kode</th>
							<th scope="col">Nama</th>
						</tr>
						</thead>
						<tbody>
							<?php $no = 1; ?>
							<?php foreach ($allData as $data) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $data['nama_supplier'] ?></td>
									<td><?= $data['tanggal'] ?></td>
									<td><?= $data['no_dokumen'] ?></td>
									<td><?= $data['kode_barang'] ?></td>
									<td><?= $data['nama_barang'] ?></td>
									<td><?= $data['qty']?></td>
									<td><?= 'Rp. ' . number_format($data['harga_satuan'], 2, ".", ",") ?></td>
									<td><?= 'Rp. ' . number_format($data['subtotal'], 2, ".", ",") ?></td>
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
