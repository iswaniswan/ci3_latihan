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
            <form method="POST">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            Detail Pembelian
                        </h3>
                    </div>                
                    <div class="card-body mb-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="text" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Supplier</label>
                            <input type="text" class="form-control" name="id_supplier" value="<?= $data['nama_supplier'] ?>" disabled>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan" disabled><?= $data['keterangan'] ?></textarea>
                        </div>					
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                        <a href="<?= site_url('pembelian/index') ?>" class="btn btn-dark">Kembali</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Item</h3>                        
                    </div>
                    <div class="card-body">
                        <?php foreach ($items as $item) { ?>
                            <div class="row item">
                                <div class="col mb-3">
                                    <label class="form-label">Barang</label>
                                    <select class="form-select" name="id_barang" disabled>
                                        <option>- Pilih -</option>
                                        <?php foreach ($allBarang as $barang) { ?>
                                            <?php $selected = $barang['id'] == $item['id_barang'] ? 'selected' : ''; ?>
                                            <option value="<?= $barang['id'] ?>" <?= $selected ?>><?= $barang['nama'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="text" class="form-control" name="harga" value="<?= $item['harga'] ?>" disabled>
                                </div>
                                <div class="col mb-3">
                                    <label class="form-label">Quantity</label>
                                    <input type="text" class="form-control" name="qty" value="<?= $item['qty'] ?>" disabled>
                                </div>	
                        </div>
                        <?php } ?>                        
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>
</html>
