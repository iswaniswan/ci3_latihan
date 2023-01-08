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
						<label class="form-label">No. Dokumen</label>
						<input type="text" class="form-control" name="tanggal" value="<?= $data['no_dokumen'] ?>" disabled>
					</div>
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
					<div class="mb-3">
						<?php $disabled = 'disabled'; $onsytle = 'disabled';
						if ($data['canUpdateStatus']) {
							$disabled = '';
							$onsytle = 'success';
						}
						?>
						<label class="form-label">Status</label>
						<?php $checked = $data['status'] == 't' ? 'checked' : ''; ?>
						<input type="checkbox" class="form-check-input mt-1" name="status" <?= $checked ?> data-id="<?= $data['id'] ?>" <?= $disabled ?>>
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
                    <div class="col-12 alert alert-danger" role="alert" style="display:none">
                        Item sudah dipilih.
                    </div>					
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
											<input data-index="<?=$index?>" type="text" class="form-control currency-input" name="items[<?=$index?>][harga]" value="<?= $item['harga'] ?>" required>
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
<style>
	.form-check-input:disabled {
		pointer-events: unset;
		cursor: not-allowed !important;
	}
</style>

<script type="text/javascript" src="<?= base_url('public/libs/js/terbilang.js') ?>"></script>
<script type="text/javascript" src="<?= base_url('public/libs/js/currencyFormatter.js') ?>"></script>
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
			if ($(this).data('index')) {
				return;
			} else {
				initFormatCurrency($(this));
			}
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

				validateDuplicates();

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
        FormatCurrency(total, "blur", "Rp.");

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

        // console.log("grandTotal: ", grandTotal);        
        $('#grand-total').val(grandTotal);
        FormatCurrency($('#grand-total'), "blur", "Rp.");

        fillElementTerbilang(grandTotal);
    }

    const fillElementTerbilang = (value) => {
        const _text = Terbilang(value);
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
			FormatCurrency(harga, "blur", "Rp.");
			const hargaValue = $(harga).val();
			$(harga).data("value", hargaValue);
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

	const showAlert = () => {
        $('.alert').fadeIn('fast');
        setTimeout(() => {
            $('.alert').fadeOut();
        }, 1000);
    }

	const validateDuplicates = () => {
        let cart = new Set();

        $('select.select-input').each(function() {

            let value = $(this).val();
            if (cart.has(value)) {   
                showAlert();
                setTimeout(() => {
                    $(this).val("").trigger("change");
                    $(this).closest('tr').find('input.currency-input').val('');
                    $(this).closest('tr').find('input.quantity-input').val('');
                    $(this).closest('tr').find('input.total-input').val(0);
                    calculateGrandTotal();
                }, 1000);                
                return;
            };
            cart.add(value);
        })
        console.log(cart);        
    }

	const initFormatCurrency = (e) => {
		$(e).on({
			keyup: function() {
				const value = $(e).val();
				const oldValue = $(e).data('value');
				// console.log("keyup " + value + " vs " + oldValue);
				if (value == oldValue) {
					return;
				}
				FormatCurrency($(e));
			},
			blur: function() {
				console.log($(e).val());
				const value = $(e).val();
				const oldValue = $(e).data('value');
				if (value == oldValue) {
					return;
				}
				FormatCurrency($(e), "blur", "Rp.");
				const newValue = $(e).val();
				$(e).data('value', newValue);
			}
		});
		$(e).attr('data-js', true);
	}

	$(document).ready(function() {
		$('select').select2();

		$('select.select-input').each(function() {
			$(this).on('select2:select', function() {
				//validate double item
				validateDuplicates();
				fillElementHarga($(this));
				const parent = $(this).closest('tr');
				const quantity = parent.find('input.quantity-input');
				setTimeout(function() {
					fillElementTotal(quantity);
				}, 100)
			});
		})

		$("input.currency-input").each(function() {
			if ($(this).data('index')) {
				return;
			} else {
				initFormatCurrency($(this));
			}
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
		validateDuplicates();
	});
</script>

