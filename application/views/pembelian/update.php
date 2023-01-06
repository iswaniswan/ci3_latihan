<div class="row">
	<div class="col-12">
		<form method="POST" action="<?= site_url('pembelian/update') ?>">
			<div class="card mb-4">
				<div class="card-header">
					<h5 class="card-title">
						Update Pembelian
					</h5>
				</div>
				<div class="card-body mb-4">
					<div class="mb-3">
						<label class="form-label">Tanggal</label>
						<input type="date" class="form-control" name="tanggal" value="<?= $data['tanggal'] ?>">
					</div>
					<div class="mb-3">
						<label class="form-label">Supplier</label>
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
					<h5 class="card-title">Daftar Item</h5>
				</div>
				<div class="card-body">
					<div class="col-12 mb-4">
						<a href="#" onclick="addItem()" class="btn btn-success">Add Item</a>
					</div>
						<table class="table table-bordered table-hover">
							<thead>
								<tr>
									<th>No</th>
									<th>Barang</th>
									<th>Harga</th>
									<th>Quantity</th>
									<th>Total</th>
									<th>Action</th>
								</tr>
							</thead>
							<?php $index = 1; ?>
							<tbody id="array-item">
								<?php foreach ($items as $item) { ?>
									<input type="hidden" value="<?= $item['id'] ?>" name="items[<?= $index ?>][id]" />
									<tr class="item">
										<td><span class="index"><?= $index ?></span></td>
										<td>
											<select class="form-select select-input" name="items[<?=$index?>][id_barang]" required>
												<option>- Pilih -</option>
												<?php foreach ($allBarang as $barang) { ?>
													<?php $selected = $barang['id'] == $item['id_barang'] ? 'selected' : ''; ?>
													<option value="<?= $barang['id'] ?>" <?= $selected ?>><?= $barang['nama'] ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<input type="text" class="form-control currency-input" name="items[<?=$index?>][harga]" value="<?= $item['harga'] ?>" required>
										</td>
										<td>
											<input type="number" class="form-control quantity-input" name="items[<?=$index?>][qty]" value="<?= $item['qty'] ?>" required>
										</td>
										<td>
											<input type="text" class="form-control total-input" name="items[<?=$index?>][total]" disabled>
										</td>
										<td>
											<button type="button" onclick="deleteMe(this)" class="btn btn-sm btn-danger"><i class="bi-trash"></i></button>
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
			</div>

		</form>
	</div>
</div>
<!-- fungsi terbilang bahasa indonesia -->
<script>
function terb_depan(uang){
	var sub = '';
	if (uang == 1) { sub='Satu '} else
	if (uang == 2) { sub='Dua '} else
	if (uang == 3) { sub='Tiga '} else
	if (uang == 4) { sub='Empat '} else
	if (uang == 5) { sub='Lima '} else
	if (uang == 6) { sub='Enam '} else
	if (uang == 7) { sub='Tujuh '} else
	if (uang == 8) { sub='Delapan '} else
	if (uang == 9) { sub='Sembilan '} else
	if (uang == 0) { sub='  '} else
	if (uang == 10) { sub='Sepuluh '} else
	if (uang == 11) { sub='Sebelas '} else
	if ((uang >= 11) && (uang<=19)) { sub = terb_depan(uang % 10)+'Belas ';} else
	if ((uang >= 20) && (uang<=99)) { sub = terb_depan(Math.floor(uang / 10))+'Puluh '+terb_depan(uang % 10);} else
	if ((uang >= 100) && (uang<=199)) { sub = 'Seratus '+terb_depan(uang-100);} else
	if ((uang >= 200) && (uang<=999)) { sub = terb_depan(Math.floor(uang/100)) + 'Ratus '+terb_depan(uang % 100);} else
	if ((uang >= 1000) && (uang<=1999)) { sub = 'Seribu '+terb_depan(uang-1000);} else
	if ((uang >= 2000) && (uang<=999999)) { sub = terb_depan(Math.floor(uang/1000)) + 'Ribu '+terb_depan(uang % 1000);} else
	if ((uang >= 1000000) && (uang<=999999999)) { sub = terb_depan(Math.floor(uang/1000000))+'Juta '+terb_depan(uang%1000000);} else
	if ((uang >= 100000000) && (uang<=999999999999)) { sub = terb_depan(Math.floor(uang/1000000000))+'Milyar '+terb_depan(uang%1000000000);} else
	if ((uang >= 1000000000000)) { sub = terb_depan(Math.floor(uang/1000000000000))+'Triliun '+terb_depan(uang%1000000000000);}
	return sub;
}
function terb_belakang(t){
	if (t.length==0){
		return '';
	}
	return t
		.split('0').join('Kosong ')
		.split('1').join('Satu ')
		.split('2').join('Dua ')
		.split('3').join('Tiga ')
		.split('4').join('Empat ')
		.split('5').join('Lima ')
		.split('6').join('Enam ')
		.split('7').join('Tujuh ')
		.split('8').join('Delapan ')
		.split('9').join('Dembilan ');
}

function terbilang(nangka) {
	var 
		v = 0,
		sisa = 0,
		tanda = '',
		tmp = '',
		sub = '',
		subkoma = '',
		p1 = '',
		p2 = '',
		pkoma = 0;
	if (nangka>999999999999999999){
		return 'Limit';
	}
	v = nangka;	
	if (v<0){
		tanda = 'Minus ';
	}
	v = Math.abs(v);
	tmp = v.toString().split('.');
	p1 = tmp[0];
	p2 = '';
	if (tmp.length > 1) {		
		p2 = tmp[1];
	}
	v = parseFloat(p1);
	sub = terb_depan(v);
	/* sisa = parseFloat('0.'+p2);
	subkoma = terb_belakang(sisa); */
	subkoma = terb_belakang(p2);
    let comma = 'Koma ';
    if (subkoma === '') {
        comma = '';
    }
	sub = tanda + sub.replace('  ',' ') +comma+ subkoma.replace('  ',' ');
	return sub.replace('  ', ' ');
}
</script>

<!-- currency formatter -->
<script type="text/javascript">
function formatNumber(n) {
  // format number 1000000 to 1,234,567
  return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur, prefix) {
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

  if (prefix) {
    input_val = prefix + " " + input_val;
  }
  
  input.val(input_val);
  var updated_len = input_val.length;
  caret_pos = updated_len - original_len + caret_pos;
  input[0].setSelectionRange(caret_pos, caret_pos);
}
</script>

<script type="text/javascript">
	var index = "<?= $index ?>";
	const createItem = () => {
		// index++;
		return `<tr class="item">
				<td><span class="index">${index}</span></td>
				<td>
					<select class="form-select select-input" name="items[${index}][id_barang]">
						<option>- Pilih -</option>
						<?php foreach ($allBarang as $barang) { ?>
							<option value="<?= $barang['id'] ?>"><?= $barang['nama'] ?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<input type="text" class="form-control currency-input" name="items[${index}][harga]">
				</td>
				<td>
					<input type="number" class="form-control quantity-input" min="1" name="items[${index}][qty]">
				</td>				
				<td>                    
					<input type="text" class="form-control total-input" name="items[${index}][total]" disabled>
				</td>
				<td>
					<button type="button" onclick="deleteMe(this)" class="btn btn-sm btn-danger"><i class="bi-trash"></i></button>
				</td>
			</tr>   `;
	}

	const addItem = () => {
		const newItem = createItem();
		let wrapper = document.querySelector('#array-item');
		// console.log(wrapper);
		// wrapper.insertAdjacentHTML('afterend', newItem);
		$(wrapper).append(newItem);
		index++;
		refreshSelect2();
        refrechInputCurrency();
        refreshInputTotal();
		refreshSelectInput();
	}

	const deleteMe = (e) => {
		e.closest('.item').remove();
		index--;
		reIndexNumber();
		calculateGrandTotal();
	}

	const reIndexNumber = () => {
		let start = 1;
		let elementIndexes = $('#array-item .index');
		elementIndexes.each(function() {
			$(this).text(start);
			start++;
		})
	}
	const refreshSelect2 = () => {
		$('select').select2();
	}

	const refrechInputCurrency = () => {
		$('input.currency-input').each(function() {
            $(this).on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() { 
                    formatCurrency($(this), "blur");
                }
            });
        });
	}

	const refreshInputTotal = () => {
        $('input.quantity-input').each(function() {
            $(this).on('keyup', function () {
                fillElementTotal($(this));
            })
        })
    }

	const refreshSelectInput = () => {
        $('select.select-input').each(function() {
            $(this).on('select2:select', function() {
                fillElementHarga($(this));

                const parent = $(this).closest('tr');
                const quantity = parent.find('input.quantity-input');
                setTimeout(function() {
                    fillElementTotal(quantity);
                }, 100)
            });
        })
    }

    const formatInt = (textInt) => {
        _int = textInt.replace("Rp. ", "").replace(".00", "").replaceAll(",", "");
        return _int;
    }

    const getTotal = (harga, qty) => {
        let _harga = formatInt(harga);
        
        return _harga * qty;
    }

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
        formatCurrency(total, "blur", "Rp.");

        // calc grandTotal
        calculateGrandTotal();
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
            grandTotal += parseFloat(this);
        });

        if (isNaN(grandTotal)) {
            $('#grand-total').val(0);
            return;
        }

        console.log("grandTotal: ", grandTotal);        
        $('#grand-total').val(grandTotal);
        formatCurrency($('#grand-total'), "blur", "Rp.");

        fillElementTerbilang(grandTotal);
    }

    const fillElementTerbilang = (value) => {
        const _text = terbilang(value);
        // console.log("terbilang", _text);
        $('#terbilang').text(_text + 'Rupiah');
    }

	const fillElementHarga = async (e) => {
        const idBarang = $(e).val();
        const hargaBarang = await getHargaBarang(idBarang);
        if (parseInt(hargaBarang) > 0) {
            const parent = $(e).closest('tr');
            const harga = parent.find('input.currency-input');
            harga.val(hargaBarang);
            formatCurrency(harga, "blur");
        }        
    }

    const getHargaBarang = async (value) => {
        return await $.ajax({
            'url': "<?= site_url('barang/getHargaBarang/') ?>",
            'method': 'POST',
            'data': {
                id_barang: value
            },
            'success': function (result) {
                return result
            }
        })
    }

	const initToCurrency = (e) => {        // return;
		const value = e.value.replace(/,/g, '');
		const valueFormatted = parseFloat(value).toLocaleString('en-US', {
			style: 'decimal',
			maximumFractionDigits: 2,
			minimumFractionDigits: 2
		});

		console.log(valueFormatted);
		e.value = valueFormatted;
	}

	$(document).ready(function() {
		$('select').select2();	
		$('select.select-input').on('select2:select', function() {
            fillElementHarga($(this));

            const parent = $(this).closest('tr');
            const quantity = parent.find('input.quantity-input');
            setTimeout(function() {
                fillElementTotal(quantity);
            }, 100)
            
        });

		$("input.currency-input").each(function() {
            $(this).on({
                keyup: function() {
                    formatCurrency($(this));
                },
                blur: function() { 
                    formatCurrency($(this), "blur", "Rp. ");
                }
            });
        });

		$('input.currency-input').each(function() {
            formatToCurrency(this);
			fillElementTotal(this);
        })

        $('input.quantity-input').each(function() {
			fillElementTotal($(this));

            $(this).on('keyup', function () {
                fillElementTotal($(this));
            })
        })

		
        calculateGrandTotal();
	});
</script>

