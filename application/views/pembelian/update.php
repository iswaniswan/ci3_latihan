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
            <form method="POST" action="<?= site_url('pembelian/update') ?>">
                <div class="card mb-4">
                    <div class="card-header">
                        <h3 class="card-title">
                            Update Pembelian
                        </h3>
                    </div>                
                    <div class="card-body mb-4">
                        <div class="mb-3">
                            <label class="form-label">Tanggal</label>
                            <input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>">
                        </div>
						<div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Supplier</label>
                            <select class="form-select" name="id_supplier">
                                <option>- Pilih -</option>
                                <?php foreach ($allSupplier as $supplier) { ?>
									<?php $selected = $supplier['id'] == $data['id_supplier'] ? 'selected' : ''; ?>
                                    <option value="<?= $supplier['id'] ?>" <?= $selected ?>><?= $supplier['nama'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Keterangan</label>
                            <textarea type="text" class="form-control" name="keterangan"><?= $data['keterangan'] ?></textarea>
                        </div>			
						<input type="hidden" name="id" value="<?= $data['id'] ?>" />		
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a href="<?= site_url('pembelian/index') ?>" class="btn btn-dark">Kembali</a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Daftar Item</h3>                        
                    </div>
                    <div class="card-body">
						<div class="col-12 mb-4">
                            <a href="#" onclick="addItem()" class="btn btn-success">Add Item</a>
                        </div>

						<div id="array-item">
							<?php $index = 0; ?>
							<?php foreach ($items as $item) { ?>
								<div class="row item">
									<div class="col-1">
										<button type="button" onclick="deleteMe(this)" class="btn btn-sm btn-danger mt-4">Hapus</button>
									</div>
									<input type="hidden" value="<?= $item['id'] ?>" name="items[<?= $index ?>][id]" />
									<div class="col mb-3">
										<label class="form-label">Barang</label>
										<select class="form-select" name="items[<?=$index?>][id_barang]">
											<option>- Pilih -</option>
											<?php foreach ($allBarang as $barang) { ?>
												<?php $selected = $barang['id'] == $item['id_barang'] ? 'selected' : ''; ?>
												<option value="<?= $barang['id'] ?>" <?= $selected ?>><?= $barang['nama'] ?></option>
											<?php } ?>
										</select>
									</div>
									<div class="col mb-3">
										<label class="form-label">Harga</label>
										<input type="text" class="form-control" name="items[<?=$index?>][harga]" value="<?= $item['harga'] ?>">
									</div>
									<div class="col mb-3">
										<label class="form-label">Quantity</label>
										<input type="text" class="form-control" name="items[<?=$index?>][qty]" value="<?= $item['qty'] ?>">
									</div>	
								</div>
							<?php $index++; } ?> 
						</div>                                            
                    </div>
                </div>

            </form>
        </div>
    </div>
</body>
<script type="text/javascript">
    var index = "<?= $index ?>";
    const createItem = () => {        
        index++;
        return `<div class="row item">      
                            <div class="col-1">
                                <button type="button" onclick="deleteMe(this)" class="btn btn-sm btn-danger mt-4">Hapus</button>
                            </div>                      
                            <div class="col mb-3">
                                <label class="form-label">Barang</label>
                                <select class="form-select" name="items[${index}][id_barang]">
                                    <option>- Pilih -</option>
                                    <?php foreach ($allBarang as $barang) { ?>
                                        <option value="<?= $barang['id'] ?>"><?= $barang['nama'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Harga</label>
                                <input type="number" class="form-control" min="1" name="items[${index}][harga]">
                            </div>
                            <div class="col mb-3">
                                <label class="form-label">Quantity</label>
                                <input type="number" class="form-control" min="1" name="items[${index}][qty]">
                            </div>	
                        </div>`;
    }

    const addItem = () => {
        const newItem = createItem();
        const wrapper = document.querySelector('#array-item');
        console.log(wrapper);
        wrapper.insertAdjacentHTML('afterend', newItem);
    }

    const deleteMe = (e) => {
        e.closest('.item').remove();
    }
</script>
</html>

