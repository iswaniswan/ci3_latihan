
<div class="row">
	<div class="container">
		<div class="card">
			<div class="card-header">
				<h3 class="card-title text-primary">
					Daftar Barang
				</h3>
			</div>
			<div class="card-body">
				<div class="col-12 mb-4">
					<a href="<?= site_url('barang/create') ?>" class="btn btn-primary">Add</a>
				</div>
				<div class="col-12">
					<?php $no = 1; ?>
					<table class="table table-hover">
						<thead>
							<tr>
							<th scope="col">#</th>
							<th scope="col">Kode</th>
							<th scope="col">Nama</th>
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
									<td>
										<div class="container">
											<a href="<?= site_url('barang/read/'.$barang['id']) ?>" class="btn btn-sm btn-success">Lihat</a>
											<a href="<?= site_url('barang/update/'.$barang['id']) ?>" class="btn btn-sm btn-warning">Edit</a>												
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