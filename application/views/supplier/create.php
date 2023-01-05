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
                    <h5 class="card-title">
                        Form Supplier
                    </h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="<?= site_url('supplier/create') ?>">
                        <div class="mb-3">
                            <label class="form-label">Kode</label>
                            <input type="text" class="form-control" name="kode">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama</label>
                            <input type="text" class="form-control" name="nama">
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= site_url('supplier/index') ?>" class="btn btn-dark">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>