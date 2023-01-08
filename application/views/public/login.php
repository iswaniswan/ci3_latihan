<div class="row align-items-center g-lg-5 py-5">
	<?php if (@$this->session->flashdata()) {
		foreach ($this->session->flashdata() as $key => $value) { ?>
			<div class="container">
				<div class="col-12 alert alert-<?=$key?> px-lg-5 px-md-4 px-sm-1 text-center" role="alert">
					<?= $this->session->flashdata($key) ?>
				</div>
			</div>
		<?php }
	} ?>
	<div class="col-lg-6 text-center">
		<h1 class="display-4 fw-bold lh-1 mb-3">App Latihan</h1>
		<p class="col-12 fs-4">Silakan login untuk menggunakan aplikasi</p>
	</div>
	<div class="col-md-10 mx-auto col-lg-5">
		<form class="p-4 p-md-5 border rounded-3 bg-light" action="<?= site_url('auth/login') ?>" method="post">
			<div class="form-floating mb-3">
				<input type="user" class="form-control" id="floatingInput" placeholder="" name="username" required>
				<label for="floatingInput">Username</label>
			</div>
			<div class="form-floating mb-3">
				<input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password" required>
				<label for="floatingPassword">Password</label>
			</div>

			<button class="w-100 btn btn-lg btn-primary" type="submit">Login</button>
			<hr class="my-4">
			<div class="text-muted text-center">Belum punya akun? <a href="<?= site_url('auth/register') ?>">REGISTER</a></div>
		</form>
	</div>
</div>

<script type="text/javascript">

	$(document).ready(function () {
		setTimeout(() => {
			$('.alert').fadeOut();
		}, 1000)
	})

</script>

