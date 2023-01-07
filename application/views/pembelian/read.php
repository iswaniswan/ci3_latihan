<div class="row">
	<?php if (@$this->session->flashdata('alert-success')) { ?>
			<div class="container">
				<div class="col-12 alert alert-success" role="alert">
					<?= $this->session->flashdata('alert-success') ?>
				</div>
			</div>
	<?php } ?>

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
						<label class="form-label">No. Dokumen</label>
						<input type="text" class="form-control" name="tanggal" value="<?= $data['no_dokumen'] ?>" disabled>
					</div>
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
					<a href="<?= site_url('pembelian/update/' . $data['id']) ?>" class="btn btn-warning">Ubah</a>
				</div>
			</div>

			<div class="card">
				<div class="card-header">
					<h3 class="card-title">Daftar Item</h3>
				</div>
				<div class="card-body">
					<table class="table table-bordered table-light">
						<thead>
							<tr>
								<th>No</th>
								<th>Barang</th>
								<th>Harga</th>
								<th>Quantity</th>
								<th>Total</th>
							</tr>
						</thead>
						<?php $index = 1; ?>
						<tbody id="array-item">
							<?php foreach ($items as $item) { ?>
								<tr class="item">
									<td><span class="index"><?= $index ?></span></td>
									<td>
										<select class="form-select" name="id_barang" disabled>
											<option>- Pilih -</option>
											<?php foreach ($allBarang as $barang) { ?>
												<?php $selected = $barang['id'] == $item['id_barang'] ? 'selected' : ''; ?>
												<option value="<?= $barang['id'] ?>" <?= $selected ?>><?= $barang['nama'] ?></option>
											<?php } ?>
										</select>
									</td>
									<td>
										<input type="text" class="form-control currency-input" name="harga" value="<?= $item['harga'] ?>" disabled>
									</td>
									<td>
										<input type="text" class="form-control quantity-input" name="qty" value="<?= $item['qty'] ?>" disabled>
									</td>
									<td>
										<input type="text" class="form-control total-input" name="total" disabled>
									</td>
								</tr>
							<?php $index++; } ?>
						</tbody>
						<tfoot>
							<tr>
								<th rowspan="2">#</th>
								<th colspan="3">Grand Total</th>
								<th>
									<input type="text" class="form-control" id="grand-total" name="" disabled>
								</th>
								<th rowspan="2"></th>
							</tr>
							<tr>
								<th>Terbilang</th>
								<th colspan="3">
									<textarea rows="2" type="text" class="form-control" id="terbilang" name="" disabled></textarea>
								</th>
							</tr>
						</tfoot>
					</table>
				</div>
			</div>

		</form>
	</div>
</div>

<script type="text/javascript" src="<?= base_url('public/libs/js/terbilang.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/libs/js/currencyFormatter.js') ?>"></script>
<script>
    // const formatToCurrency = (e) => {        // return;
    //     const value = e.value.replace(/,/g, '');
    //     e.value = parseFloat(value).toLocaleString('en-US', {
    //         style: 'decimal',
    //         maximumFractionDigits: 2,
    //         minimumFractionDigits: 2
    //     });
	// 	e.value = 'Rp. ' + e.value;
    // }

	const fillElementTotal = (e) => {
        //get harga
        let parent = $(e).closest('tr');
        let harga = parent.find('input.currency-input').val();        
        let quantity = parent.find('input.quantity-input').val();
        let value = getTotal(harga, quantity);
        
        if (isNaN(value)) {
            value = 0;
        }        
        
        let total = parent.find('input.total-input');
        total.val(value);
        FormatCurrency(total, "blur", "Rp.");

        // calc grandTotal
        calculateGrandTotal();
    }

	const formatInt = (textInt) => {
        _int = textInt.replace("Rp. ", "").replace(".00", "").replaceAll(",", "");
        return _int;
    }

    const getTotal = (harga, qty) => {
        let _harga = formatInt(harga);
        
        return _harga * qty;
    }

	const calculateGrandTotal = () => {        
        let arrayHarga = [];
        $('input.total-input').each(function() {
            let total = $(this).val();
            let value = formatInt(total); 
            arrayHarga.push(value);
        })

        let grandTotal = 0;
        $.each(arrayHarga, function() {
            grandTotal += parseFloat(this);
        });

        if (isNaN(grandTotal)) {
            $('#grand-total').val(0);
            return;
        }

        // console.log("grandTotal: ", grandTotal);        
        $('#grand-total').val(grandTotal);
        FormatCurrency($('#grand-total'), "blur", "Rp.");

        fillElementTerbilang(grandTotal);
    }

    const fillElementTerbilang = (value) => {
        const _text = Terbilang(value);
        $('#terbilang').text(_text + 'Rupiah');
    }

    $(document).ready(function() {
        $('input.currency-input').each(function() {
            // formatToCurrency(this);
			FormatCurrency($(this), "blur", "Rp. ")
			fillElementTotal(this);
        })

		calculateGrandTotal();

		setTimeout(() => {
			$('.alert').fadeOut();
		}, 2000)
    })

</script>
