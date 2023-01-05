<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
	<link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap-toggle.min.css') ?>">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
    <script src="<?= base_url('public/assets/js/jquery-3.6.3.min.js') ?>"></script>	
	<script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>
	<script src="<?= base_url('public/assets/js/bootstrap-toggle.min.js') ?>"></script>

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
						Daftar Supplier
					</h3>
				</div>
				<div class="card-body">
					<div class="col-12 mb-4">
						<a href="<?= site_url('supplier/create') ?>" class="btn btn-primary">Add</a>
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
							<?php foreach ($allSupplier as $supplier) { ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $supplier['kode'] ?></td>
									<td><?= $supplier['nama'] ?></td>
									<td>
										<div class="container">
											<a href="<?= site_url('supplier/read/'.$supplier['id']) ?>" class="btn btn-sm btn-success">Lihat</a>
											<a href="<?= site_url('supplier/update/'.$supplier['id']) ?>" class="btn btn-sm btn-warning">Edit</a>											
										</div>
									</td>
									<td>
										<?php $checked = $supplier['status'] == 't' ? 'checked' : ''; ?>
										<input type="checkbox" name="status"
											class="bootstrap-toggle" <?= $checked ?> 
											data-toggle="toggle" 
											data-size="small" 
											data-on="Active" 
											data-off="Inactive" 
											data-onstyle="info"
											data-id="<?= $supplier['id'] ?>">
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
<script>
	$(function() {
		$('.bootstrap-toggle').bootstrapToggle();

		$('.bootstrap-toggle').each(function() {
			$(this).change(function() {
				const status = $(this).prop('checked');
				const id = $(this).data('id');
				console.log(id, status);
				$.ajax({
					'url': "<?= site_url('supplier/updateStatus') ?>",
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
</script>
</html>
