
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
				<div class="card-header">
					<ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
						<li class="nav-item">
							<a class="nav-link text-center active " id="vendor-owner-tab" data-toggle="tab" href="#vendor-owner" role="tab" aria-controls="vendor-owner" aria-selected="true">
								Form Registrasi <br/>Pemilik Lapangan
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link text-center" id="commite-tab" data-toggle="tab" href="#commite" role="tab" aria-controls="commite" aria-selected="false">
								Form Registrasi <br/>Penyelenggara Event
							</a>
						</li>
					</ul>
				</div>
					<div class="card-body">
						<div class="tab-content mt-4" id="myTabContent">
							<?php if($this->session->flashdata('message')) { ?>
								<div class="alert <?= strpos($this->session->flashdata('message'), 'gagal') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert">
									<i class="fa fa-minus-circle mr-2"></i> 
									<?= $this->session->flashdata('message') ?>
									<button type="button" class="close" data-dismiss="alert" aria-label="Close">
										<span aria-hidden="true">&times;</span>
									</button>
								</div>
							<?php } ?>
							<div class="tab-pane fade show active" id="vendor-owner" role="tabpanel" aria-labelledby="vendor-owner-tab">
								<?= form_open('auth/register', array('method' => 'POST', 'name' => 'accountRegister')); ?>
									<?= form_hidden('groupId', 2) ?>
									<div class="form-group row">
										<?= form_label('Nama *','name', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('name',set_value('name'), array_merge($inputAttr, array('id' => 'name', 'required' => null, 'autofocus' => null))); ?>
											<?= form_error('name'); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<?= form_label('Telepon *','phone', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('phone',set_value('phone'), array_merge($inputAttr, array('id' => 'phone', 'required' => null))); ?>
											<?= form_error('phone'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Alamat Email *','email', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('email',set_value('email'), array_merge($inputAttr, array('id' => 'email', 'required' => null))); ?>
											<?= form_error('email'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Password *','password', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_password('password', set_value('password'), array_merge($inputAttr, array('id' => 'password', 'required' => null))); ?>
											<?= form_error('password'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Tipe Rekening','bankName', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_dropdown('bankName', $bankOptions, '', $inputAttr); ?>
											<?= form_error('bankName'); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<?= form_label('Nomor Rekening','bankAccount', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('bankAccount',set_value('bankAccount'), array_merge($inputAttr, array('id' => 'bankAccount'))); ?>
											<?= form_error('bankAccount'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Nama di Rekening','accountName', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('accountName',set_value('accountName'), array_merge($inputAttr, array('id' => 'accountName'))); ?>
											<?= form_error('accountName'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Nama tempat basket*','vendorName', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('vendorName',set_value('vendorName'), array_merge($inputAttr, array('id' => 'vendorName', 'required' => null))); ?>
											<?= form_error('vendorName'); ?>
										</div>
									</div>

									<!-- <div class="form-group row">
										<?= form_label('Alamat tempat basket*','vendorAddress', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_textarea(array('name'=> 'vendorAddress', 'rows' => '4'), set_value('vendorAddress'), array_merge($inputAttr, array('id' => 'vendorAddress', 'required' => null))); ?>
											<?= form_error('vendorAddress'); ?>
										</div>
									</div> -->
									
							        <div class="form-group row">
							            <div class="col-sm-12">
											<div class="map_canvas1"></div>
										</div>
									</div>

							        <div class="form-group">
							            <?= form_label('Lokasi*'); ?>
							            <div class="col-sm-12">
							                <div class="input-group">
							                    <input id="geocomplete1" type="text" class="form-control" placeholder="Type in an address" value="Bandung, Bandung City, West Java, Indonesia" />
							                    <div class="input-group-button">
							                      <input id="find1" type="button" class="btn btn-default" value="find" />
							                        
							                    </div>
							                </div>
							                
							            </div>
							        </div>

							          
							            <input name="lat" class="lat1" type="hidden" value="">
							          
							            <input name="lng" class="lng1" type="hidden" value="">
							          
							          

									<div class="form-group no-margin">
										<button type="submit" class="btn btn-primary btn-block">
											Daftar
										</button>
									</div>
									<div class="margin-top20 text-center">
										Sudah memiliki akun? <a href="<?=base_url()?>auth">Login</a>
									</div>

								<?= form_close() ?>
							</div>
							<div class="tab-pane fade" id="commite" role="tabpanel" aria-labelledby="commite-tab">
								<?= form_open('auth/register', array('method' => 'POST', 'name' => 'accountRegister')); ?>
									<?= form_hidden('groupId', 4) ?>
									<div class="form-group row">
										<?= form_label('Nama Lengkap *','name', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('name',set_value('name'), array_merge($inputAttr, array('id' => 'name', 'required' => null, 'autofocus' => null))); ?>
											<?= form_error('name'); ?>
										</div>
									</div>
									
									<div class="form-group row">
										<?= form_label('Telepon *','phone', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('phone',set_value('phone'), array_merge($inputAttr, array('id' => 'phone', 'required' => null))); ?>
											<?= form_error('phone'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Alamat Email *','email', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_input('email',set_value('email'), array_merge($inputAttr, array('id' => 'email', 'required' => null))); ?>
											<?= form_error('email'); ?>
										</div>
									</div>

									<div class="form-group row">
										<?= form_label('Password *','password', $labelAttr); ?>
										<div class="col-sm-8">
											<?= form_password('password', set_value('password'), array_merge($inputAttr, array('id' => 'password', 'required' => null))); ?>
											<?= form_error('password'); ?>
										</div>
									</div>

									 <div class="form-group row">
							            <div class="col-sm-12">
											<div class="map_canvas2"></div>
										</div>
									</div>

							        <div class="form-group">
							            <?= form_label('Lokasi*'); ?>
							            <div class="col-sm-12">
							                <div class="input-group">
							                    <input id="geocomplete2" type="text" class="form-control" placeholder="Type in an address" value="Bandung, Bandung City, West Java, Indonesia" />
							                    <div class="input-group-button">
							                      <input id="find2" type="button" class="btn btn-default" value="find" />
							                        
							                    </div>
							                </div>
							                
							            </div>
							        </div>

							          
							            <input name="lat" class="lat2" type="hidden" value="">
							          
							            <input name="lng" class="lng2" type="hidden" value="">
							          

									<div class="form-group no-margin">
										<button type="submit" class="btn btn-primary btn-block">
											Daftar
										</button>
									</div>
									<div class="margin-top20 text-center">
										Sudah memiliki akun? <a href="<?=base_url()?>auth">Login</a>
									</div>

								<?= form_close() ?>
							</div>
						</div>
					</div>
				</div>
				<div class="footer">
					Copyright &copy; Basket Ball League <?= date("Y"); ?>
				</div>
			</div>
		</div>
	</div>
</section>
</div>
<!-- 
<script>
	function initMap() {
	var uluru = {lat: -25.363, lng: 131.044};
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 4,
		center: uluru
	});
	var marker = new google.maps.Marker({
		position: uluru,
		map: map
	});
	}
</script> -->

<!-- 
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBXDicxeq5eKI4dwzm0-ZbTGrGZRbLN6OM&callback=initMap">
</script>
     -->