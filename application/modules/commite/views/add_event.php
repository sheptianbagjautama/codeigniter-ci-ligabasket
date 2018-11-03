<style type="text/css">
    
#geocomplete { width: 200px}

.map_canvas { 
  width: 600px; 
  height: 400px; 
  margin: 10px 20px 10px 0;
}

#multiple li { 
  cursor: pointer; 
  text-decoration: underline; 
}
</style>
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
            <?= form_open_multipart('commite/event/add', array('method' => 'POST', 'name' => 'addEvent')); ?>
                <div class="form-group row">
                    <?= form_label('Nama Event*','name', $labelAttr); ?>
                    <div class="col-sm-8">
                        <?= form_input('name',set_value('name'), array_merge($inputAttr, array('id' => 'name', 'required' => true, 'autofocus' => true))); ?>
                        <?= form_error('name'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?= form_label('Deskripsi Event*','description', $labelAttr); ?>
                    <div class="col-sm-8">
                        <?= form_textarea(array('name'=> 'description', 'rows' => '5'), set_value('description'), array_merge($inputAttr, array('id' => 'description', 'required' => null))); ?>
                        <?= form_error('description'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?= form_label('Tanggal Event*','event_date', $labelAttr); ?>
                    <div class="col-sm-8">
                        <?= form_input('event_date', set_value('event_date'), array_merge($inputAttr, array('id' => 'event_date', 'class'=> 'form-control datepicker', 'required' => false, 'autofocus' => null))); ?>
                        <?= form_error('event_date'); ?>
                    </div>
                </div>

                <div class="form-group row">
                    <?= form_label('Biaya Pendaftaran*','price', $labelAttr); ?>
                    <div class="col-sm-8">
                        <?= form_input('price',set_value('price'), array_merge($inputAttr, array('id' => 'price', 'required' => false, 'autofocus' => null))); ?>
                        <?= form_error('price'); ?>
                    </div>
                </div>
                <div class="form-group row">
                    <?= form_label('Banner*','image', $labelAttr); ?>
                    <div class="col-sm-8">
                        <?= form_upload('image', set_value('image'), array_merge($inputAttr, array('id' => 'image', 'autofocus' => null))); ?>
                        <?= form_error('image'); ?>
                    </div>
                </div>
                <!-- <div class="form-group row">
                    <?= form_label('Lokasi*','vendor', $labelAttr); ?>
                    <div class="col-sm-8">
                        <?= form_dropdown('vendor', $vendorOptions, '', $inputAttr); ?>
                        <?= form_error('vendor'); ?>
                    </div>
                </div> -->

                <div class="map_canvas"></div>

                <div class="form-group row">
                    <?= form_label('Lokasi*'); ?>
                    <div class="col-sm-8">
                        <div class="input-group">
                            <input id="geocomplete" type="text" class="form-control" placeholder="Type in an address" value="111 Broadway, New York, NY" />
                            <div class="input-group-button">
                              <input id="find" type="button" class="btn btn-default" value="find" />
                                
                            </div>
                        </div>
                        
                    </div>
                </div>

                  
                    <input name="lat" type="hidden" value="">
                  
                    <input name="lng" type="hidden" value="">
                  
                  
                  

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
