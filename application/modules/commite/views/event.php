
</section><section class="row">
    <div class="col-sm-7 col-md-7 col-lg-7">
        <div class="card">
            <div class="card-title data-table">
                <button  id="buttonAdd" data-url="<?= current_url() . '/add_form'  ?>" type="button" class="add btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Event</button>
            </div>
            <div class="card-block">
                <table id="dataTable" class="table-striped table-hover dataTable dataEvent" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nama Event</th>
                            <th>Tanggal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $idx=>$row) { ?>
                            <?php 
                                $bgType = 'bg-danger';
                                if($row->status == 'published' ) {
                                    $bgType = 'bg-success';
                                } 
                            ?>
                            <tr data-vendor='<?= $row->vendor ?>' data-status='<?= $row->status ?>' data-date='<?= $row->event_date ?>' data-name='<?= $row->name ?>' data-image='<?= $row->image ?>' data-description='<?= $row->description ?>' data-phone='<?= $row->phone ?>' data-address='<?= $row->address ?>' data-id='<?= $row->id ?>' >
                                <td><?= ++$idx; ?></td>
                                <td><?= $row->name; ?></td>
                                <td><?= $row->event_date; ?></td>
                                <td style="text-align: center">
                                    <div class="alert <?= $bgType ?>"><?= $row->status; ?></span>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </div>
    <div class="col-sm-5 col-md-5 col-lg-5">
        <div class="card detail data-event mb-4" style="display: none">
            <div class="card-block">
                <h3 class="card-title"></h3>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <div class="content row border-top" style="margin: 10px;">

                    <table class="table">
                        <tr>
                            <td>Lokasi</td>
                            <td align="right" id="vendor"></td>
                        </tr>
                        <tr>
                            <td>Alamat</td>
                            <td align="right" id="address"></td>
                        </tr>
                        <tr>
                            <td>Tanggal</td>
                            <td align="right" id="date"></td>
                        </tr>
                    </table>
                    
                    <div class="col-md-12 action border-top" style="display: none">
                        <button id="eventPublishBtn" type="button" class="btn btn-success">Publish Event</button>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
</section>
