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
											<select class="form-select" name="items[<?=$index?>][id_barang]" required>
												<option>- Pilih -</option>
												<?php foreach ($allBarang as $barang) { ?>
													<?php $selected = $barang['id'] == $item['id_barang'] ? 'selected' : ''; ?>
													<option value="<?= $barang['id'] ?>" <?= $selected ?>><?= $barang['nama'] ?></option>
												<?php } ?>
											</select>
										</td>
										<td>
											<input type="hidden" class="form-control currency-input-value" name="items[<?= $index ?>][harga]">
											<input type="text" class="form-control currency-input" value="<?= $item['harga'] ?>">
										</td>
										<td>
											<input type="text" class="form-control" name="items[<?=$index?>][qty]" value="<?= $item['qty'] ?>" required>
										</td>
										<td>
											<button type="button" onclick="deleteMe(this)" class="btn btn-sm btn-danger">Hapus</button>
										</td>
									</tr>
								<?php $index++; } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>

		</form>
	</div>
</div>
<script type="text/javascript">
	var index = "<?= $index ?>";
	const createItem = () => {
		// index++;
		return `<tr class="item">
				<td><span class="index">${index}</span></td>
				<td>
					<select class="form-select" name="items[${index}][id_barang]">
						<option>- Pilih -</option>
						<?php foreach ($allBarang as $barang) { ?>
							<option value="<?= $barang['id'] ?>"><?= $barang['nama'] ?></option>
						<?php } ?>
					</select>
				</td>
				<td>
					<input type="hidden" class="form-control currency-input-value" name="items[${index}][harga]">
					<input type="text" class="form-control currency-input">
				</td>
				<td>
					<input type="number" class="form-control" min="1" name="items[${index}][qty]">
				</td>
				<td>
					<button type="button" onclick="deleteMe(this)" class="btn btn-sm btn-danger">Hapus</button>
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
	}

	const deleteMe = (e) => {
		e.closest('.item').remove();
		index--;
		reIndexNumber();
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
			$(this).on('blur', function() {
				formatToCurrency(this);
			})
		});
	}

	const formatToCurrency = (e) => {        // return;
		const value = e.value.replace(/,/g, '');
		const valueFormatted = parseFloat(value).toLocaleString('en-US', {
			style: 'decimal',
			maximumFractionDigits: 2,
			minimumFractionDigits: 2
		});

		console.log(valueFormatted);
		e.value = valueFormatted;

		const savedValue = valueFormatted.replace(/,/g, '').replace(/\.00/g,'');
		$(e).siblings('.currency-input-value').val(savedValue);

	}

	$(document).ready(function() {
		$('select').select2();		

		$('input.currency-input').each(function() {
			formatToCurrency(this);
			$(this).on('blur', function() {
				formatToCurrency(this);
			});
		})
	});
</script>

