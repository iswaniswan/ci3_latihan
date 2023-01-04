<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/bootstrap.min.css') ?>">
    <link rel="shortcut icon" href="data:image/x-icon;," type="image/x-icon"> 
    <script src="<?= base_url('public/assets/js/bootstrap.min.js') ?>"></script>    
    <title>Read</title>
</head>
<body class="p-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Detail Pembelian
                    </h3>
                </div>
                <?php// var_dump ($data) ?>
                <div class="card-body">
                    <form method="POST" action="<?= site_url('barang/create') ?>">
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" name="id_supplier" value="<?= $data['nama_supplier'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Barang</label>
                            <input type="text" class="form-control" name="id_barang" value="<?= $data['nama_barang'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Harga</label>
                            <input type="text" class="form-control" name="harga" value="<?= $data['harga'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Quantity</label>
                            <input type="text" class="form-control" name="qty" value="<?= $data['qty'] ?>" disabled>
                        </div>
						<div class="mb-3">
							<label class="form-label">Keterangan</label>
							<input type="text" class="form-control" name="keterangan" value="<?= $data['keterangan'] ?>" disabled>
						</div>
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
