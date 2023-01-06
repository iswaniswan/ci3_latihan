<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">
                    Detail Barang
                </h5>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Kode</label>
                        <input type="text" class="form-control" name="kode" value="<?= $data['kode'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" class="form-control" name="nama" value="<?= $data['nama'] ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Harga</label>
                        <input type="text" class="form-control" name="harga" value="<?= 'Rp. ' . number_format($data['harga'], 2, ".", ",") ?>" disabled>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Status</label>
                        <?php $checked = $data['status'] == 't' ? 'checked' : ''; ?>
                        <input type="checkbox" class="form-check-input mt-1" name="status" <?= $checked ?> disabled>
                    </div>
                    <a href="<?= site_url('barang/index') ?>" class="btn btn-dark">
                        Kembali
                    </a>                        
                </form>
            </div>
        </div>
    </div>
</div>
