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

<!-- fungsi terbilang bahasa indonesia -->
<script>
    const terbilang = (a) => {
		let kalimat = ''; let utama = ''; let depan = ''; let belakang = '';
		let bilangan = ['','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan','Sepuluh','Sebelas'];

	// 1 - 11
	if(a < 12){
		kalimat = bilangan[a];
	}
	// 12 - 19
	else if(a < 20){
		kalimat = bilangan[a-10]+' Belas';
	}
	// 20 - 99
	else if(a < 100){
		utama = a/10;
		depan = parseInt(String(utama).substr(0,1));
		belakang = a%10;
		kalimat = bilangan[depan]+' Puluh '+bilangan[belakang];
	}
	// 100 - 199
	else if(a < 200){
		kalimat = 'Seratus '+ terbilang(a - 100);
	}
	// 200 - 999
	else if(a < 1000){
		utama = a/100;
		depan = parseInt(String(utama).substr(0,1));
		belakang = a%100;
		kalimat = bilangan[depan] + ' Ratus '+ terbilang(belakang);
	}
	// 1,000 - 1,999
	else if(a < 2000){
		kalimat = 'Seribu '+ terbilang(a - 1000);
	}
	// 2,000 - 9,999
	else if(a < 10000){
		utama = a/1000;
		depan = parseInt(String(utama).substr(0,1));
		belakang = a%1000;
		kalimat = bilangan[depan] + ' Ribu '+ terbilang(belakang);
	}
	// 10,000 - 99,999
	else if(a < 100000){
		utama = a/100;
		depan = parseInt(String(utama).substr(0,2));
		belakang = a%1000;
		kalimat = terbilang(depan) + ' Ribu '+ terbilang(belakang);
	}
	// 100,000 - 999,999
	else if(a < 1000000){
		utama = a/1000;
		depan = parseInt(String(utama).substr(0,3));
		belakang = a%1000;
		kalimat = terbilang(depan) + ' Ribu '+ terbilang(belakang);
	}
	// 1,000,000 - 	99,999,999
	else if(a < 100000000){
		utama = a/1000000;
		depan = parseInt(String(utama).substr(0,4));
		belakang = a%1000000;
		kalimat = terbilang(depan) + ' Juta '+ terbilang(belakang);
	}
	else if(a < 1000000000){
		utama = a/1000000;
		depan = parseInt(String(utama).substr(0,4));
		belakang = a%1000000;
		kalimat = terbilang(depan) + ' Juta '+ terbilang(belakang);
	}
	else if(a < 10000000000){
		utama = a/1000000000;
		depan = parseInt(String(utama).substr(0,1));
		belakang = a%1000000000;
		kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
	}
	else if(a < 100000000000){
		utama = a/1000000000;
		depan = parseInt(String(utama).substr(0,2));
		belakang = a%1000000000;
		kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
	}
	else if(a < 1000000000000){
		utama = a/1000000000;
		depan = parseInt(String(utama).substr(0,3));
		belakang = a%1000000000;
		kalimat = terbilang(depan) + ' Milyar '+ terbilang(belakang);
	}
	else if(a < 10000000000000){
		utama = a/10000000000;
		depan = parseInt(String(utama).substr(0,1));
		belakang = a%10000000000;
		kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
	}
	else if(a < 100000000000000){
		utama = a/1000000000000;
		depan = parseInt(String(utama).substr(0,2));
		belakang = a%1000000000000;
		kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
	}

	else if(a < 1000000000000000){
		utama = a/1000000000000;
		depan = parseInt(String(utama).substr(0,3));
		belakang = a%1000000000000;
		kalimat = terbilang(depan) + ' Triliun '+ terbilang(belakang);
	}

  else if(a < 10000000000000000){
		utama = a/1000000000000000;
		depan = parseInt(String(utama).substr(0,1));
		belakang = a%1000000000000000;
		kalimat = terbilang(depan) + ' Kuadriliun '+ terbilang(belakang);
	}

	var pisah = kalimat.split(' ');
	var full = [];
	for(var i=0;i<pisah.length;i++){
	 if(pisah[i] != ""){full.push(pisah[i]);}
	}
	return full.join(' ');
}
</script>



<!-- currency formatter -->
<script type="text/javascript">
function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
  var input_val = input.val();

  if (input_val === "") { return; }
  var original_len = input_val.length;
  var caret_pos = input.prop("selectionStart");
  if (input_val.indexOf(".") >= 0) {
    var decimal_pos = input_val.indexOf(".");
    var left_side = input_val.substring(0, decimal_pos);
    var right_side = input_val.substring(decimal_pos);
    left_side = formatNumber(left_side);
    right_side = formatNumber(right_side);
    if (blur === "blur") {
      right_side += "00";
    }
    right_side = right_side.substring(0, 2);
    input_val = left_side + "." + right_side;

  } else {
    input_val = formatNumber(input_val);
    input_val = input_val;
    if (blur === "blur") {
      input_val += ".00";
    }
  }
  
  input.val(input_val);
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}

</script>
<script>
    const formatToCurrency = (e) => {        // return;
        const value = e.value.replace(/,/g, '');
        e.value = parseFloat(value).toLocaleString('en-US', {
            style: 'decimal',
            maximumFractionDigits: 2,
            minimumFractionDigits: 2
        });
		e.value = 'Rp. ' + e.value;
    }

	const fillElementTotal = (e) => {
        //get harga
        let parent = $(e).closest('tr');
        let harga = parent.find('input.currency-input').val();
        
        let quantity = parent.find('input.quantity-input').val();

        let value = getTotal(harga, quantity);
        
        if (isNaN(value)) {
            value = 0;
        }        
        
        // let valueFormatted = formatNumber(value.toString()) + ".00";
        let total = parent.find('input.total-input');
        total.val(value);
        formatCurrency(total, "blur");

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
        $.each(arrayHarga,function() {
            grandTotal += parseInt(this);
        });
        console.log("grandTotal: ", grandTotal);        
        $('#grand-total').val(grandTotal);
        formatCurrency($('#grand-total'), "blur");

		fillElementTerbilang(grandTotal);
    }

    const fillElementTerbilang = (value) => {
        const _text = terbilang(value);
        console.log("terbilang", _text);
        $('#terbilang').text(_text);
    }

    $(document).ready(function() {
        $('input.currency-input').each(function() {
            formatToCurrency(this);
			fillElementTotal(this);
        })

		calculateGrandTotal();
    })

</script>
