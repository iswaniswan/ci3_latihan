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
    <div class="row">
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
        <div class="col-12 text-center">
            <h1 class="display-4 text-primary">
                Barang
            </h1>
        </div>
    </div>
    <div class="row">
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
                                    <a href="<?= site_url('barang/delete/'.$barang['id']) ?>" class="btn btn-sm btn-danger">Hapus</a>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>