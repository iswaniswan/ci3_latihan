<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
    <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>    
    <title>Create</title>
</head>
<body class="p-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Form Update Pembelian
                    </h3>
                </div>
				<div class="card-body">
					<form method="POST" action="<?= site_url('pembelian/update') ?>">
						<div class="mb-3">
							<label class="form-label">Tanggal</label>
							<input type="text" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>" >
						</div>
						<div class="input-group mb-3">
							<label class="input-group-text" for="inputGroupSelect01">Supplier</label>
							<select class="form-select" name="id_supplier">
								<option>- Pilih -</option>
								<?php $selected = false; ?>
								<?php foreach ($allSupplier as $supplier) { ?>
									<?php if ($supplier['id'] == $data['id_supplier']) $selected = 'selected'; ?>
									<option value="<?= $supplier['id'] ?>" <?= $selected ?>><?= $supplier['nama'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="input-group mb-3">
							<label class="input-group-text" for="inputGroupSelect01">Barang</label>
							<select class="form-select" name="id_barang">
								<option>- Pilih -</option>
								<?php $selected = false; ?>
								<?php foreach ($allBarang as $barang) { ?>
									<?php if ($barang['id'] == $data['id_barang']) $selected = 'selected'; ?>
									<option value="<?= $barang['id'] ?>" <?= $selected ?>><?= $barang['nama'] ?></option>
								<?php } ?>
							</select>
						</div>
						<div class="mb-3">
							<label class="form-label">Harga</label>
							<input type="text" class="form-control" name="harga" value="<?= $data['harga'] ?>" >
						</div>
						<div class="mb-3">
							<label class="form-label">Quantity</label>
							<input type="text" class="form-control" name="qty" value="<?= $data['qty'] ?>" >
						</div>
						<div class="mb-3">
							<label class="form-label">Keterangan</label>
							<input type="text" class="form-control" name="keterangan" value="<?= $data['keterangan'] ?>" >
						</div>
						<input type="hidden" value="<?= $data['id'] ?>" name="id">
					 	<button type="submit" class="btn btn-primary">Submit</button>
					</form>
				</div>
            </div>
        </div>
    </div>
</body>
</html>
