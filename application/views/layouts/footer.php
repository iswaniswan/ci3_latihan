</body>
<script>
	$(function() {
		$('.bootstrap-toggle').bootstrapToggle();

		$('.bootstrap-toggle').each(function() {
			$(this).change(function() {
				const status = $(this).prop('checked');
				const id = $(this).data('id');
				console.log(id, status);
				$.ajax({
					'url': "<?= site_url('barang/updateStatus') ?>",
					'method': 'POST',
					'data': {
						id: id,
						status:status
					},
					success: function(result){
						if (result === 'success') {
							location.reload();
						}
					}
				})
			})
		})
	})
</script>
</html>
