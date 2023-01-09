/*
* contoh params
*
let params = {
	'action': 'barang/update-status',
	'method': 'post',
	'inputs': [
		{'name': 'id', 'value': '1'},
		{'name': 'status', 'value': 'true'}
	]
}
*
*/
const InstanceSubmitForm = (params) => {
	let form = $(document.createElement('form'));
	$(form).attr("action", params?.action);
	$(form).attr("method", params?.method);
	params.inputs.forEach((e) => {
		// console.log(e)
		const input = $("<input>").attr("type", "hidden").attr("name", e?.name).val(e?.value);
		$(form).append($(input));
	});
	$(document.body).append(form);
	$(form).submit();
	// console.log($(form));
}
