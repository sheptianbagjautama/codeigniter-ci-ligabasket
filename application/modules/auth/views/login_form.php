
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<div class="my-login-page">
<section class="h-100">
	<div class="container h-100">
		<div class="row justify-content-md-center h-100">
			<div class="card-wrapper">
				<div class="brand">
					<img src="<?=base_url()?>assets/images/logo.png">
				</div>
				<div class="card fat">
					<div class="card-body">
						<h4 class="card-title">Login</h4>
						<?php if($this->session->flashdata('message')) { ?>
							<div class="alert <?= strpos($this->session->flashdata('message'), 'gagal') !== false ||  strpos($this->session->flashdata('message'), 'Incorrect') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert">
								<i class="fa fa-minus-circle mr-2"></i> 
								<?= $this->session->flashdata('message') ?>
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							
						<?php } ?>
						<form method="post" action="<?php echo site_url("auth/login"); ?>">
						
							<div class="form-group">
								<label for="email">E-Mail Address</label>
								<input id="email" type="email" class="form-control" name="email" value="<?= $this->session->userdata('email') ?>" required autofocus>
							</div>

							<div class="form-group">
								<label for="password">Password
									<a href="#" class="float-right">
										Lupa Password?
									</a>
								</label>
								<input id="password" type="password" class="form-control" name="password" required data-eye>
							</div>

							<div class="form-group">
								<label>
									<input type="checkbox" name="remember"> Remember Me
								</label>
							</div>

							<div class="form-group no-margin">
								<button type="submit" class="btn btn-primary btn-block">
									Login
								</button>
							</div>
							<div class="margin-top20 text-center">
								Belum memiliki akun? <a href="<?=base_url()?>auth/registration">Registrasi Akun</a>
							</div>
						</form>
					</div>
				</div>
				<div class="footer">
					Copyright &copy; Basketball League <?= date("Y"); ?>
				</div>
			</div>
		</div>
	</div>
</section>
</div>

<script src="<?=base_url()?>assets/js/login.js"></script>