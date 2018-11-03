<section class="row">
    <div class="col-sm-8 col-md-8 col-lg-8">
        <div class="card">
            <div class="card-block">
                <?php if($this->session->flashdata('message')) { ?>
                    <div class="alert <?= strpos($this->session->flashdata('message'), 'gagal') !== false ? 'alert-danger' : 'alert-success' ?> alert-dismissible fade show" role="alert">
                        <i class="fa fa-minus-circle mr-2"></i> 
                        <?= $this->session->flashdata('message') ?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                <?php } ?>
                <?= form_open_multipart('vendor/data_lapangan/add', array('method' => 'POST', 'name' => 'addLapangan')); ?>
                    <div class="form-group row">
                        <?= form_label('Nama Lapangan*','name', $labelAttr); ?>
                        <div class="col-sm-8">
                            <?= form_input('name',set_value('name'), array_merge($inputAttr, array('id' => 'name', 'required' => true, 'autofocus' => true))); ?>
                            <?= form_error('name'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <?= form_label('Harga sewa*','rent_price', $labelAttr); ?>
                        <div class="col-sm-8">
                            <?= form_input('rent_price',set_value('rent_price'), array_merge($inputAttr, array('id' => 'rent_price', 'required' => false, 'autofocus' => null))); ?>
                            <?= form_error('rent_price'); ?>
                        </div>
                    </div>
                    <div class="form-group row">
                        <?= form_label('Foto Lapangan','image', $labelAttr); ?>
                        <div class="col-sm-8">
                            <?= form_upload('image', set_value('image'), array_merge($inputAttr, array('id' => 'image', 'autofocus' => null))); ?>
                            <?= form_error('image'); ?>
                        </div>
                    </div>
                    <div class="form-group no-margin">
                        <button type="submit" class="btn btn-success">
                            Tambahkan
                        </button>
                    </div>
                <?= form_close() ?>
            </div>
        </div>
    </div>
</sction>
