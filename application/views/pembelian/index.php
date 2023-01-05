<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
    <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
    <title>Index</title>
</head>
<body class="p-4">
    <div class="row mb-5">
        <ul class="nav justify-content-end">
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('barang/index') ?>">Barang</a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="<?= site_url('supplier/index') ?>">Supplier</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="<?= site_url('pembelian/index') ?>">Pembelian</a>
            </li>
        </ul>
    </div>

    <div class="row">
		<div class="container">
			<div class="card">
				<div class="card-header">
					<h3 class="card-title text-primary">
						Daftar Pembelian
					</h3>
				</div>
				<div class="card-body">
					<div class="col-12 mb-4">
						<a href="<?= site_url('pembelian/create') ?>" class="btn btn-primary">Add</a>
					</div>
					<div class="col-12">
						<?php $no = 1; ?>
						<table class="table table-hover">
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
												<a href="<?= site_url('pembelian/read/'.$pembelian['id']) ?>" class="btn btn-sm btn-success">Lihat</a>
												<a href="<?= site_url('pembelian/update/'.$pembelian['id']) ?>" class="btn btn-sm btn-warning">Edit</a>
												<a href="<?= site_url('pembelian/delete/'.$pembelian['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
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
</body>
</html>
