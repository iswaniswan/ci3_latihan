const Pembelian = (props) => {
	let index = props?.index;
	const createItem = () => {
		index++;
		const newItem = `<tr class="item">
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
                        <input type="text" class="form-control currency-input" name="items[${index}][harga]" value="" data-value="">
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
                </tr>`;
		let wrapper = $('#array-item');
		$(wrapper).append(newItem);
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


}
