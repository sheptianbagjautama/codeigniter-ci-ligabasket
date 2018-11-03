<section class="row">
    <div class="col-sm-7 col-md-7 col-lg-7">
        <div class="card">
            <div class="card-block">
                <table id="dataTable" class="table-striped table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Logo</th>
                            <th>Nama Team</th>
                            <th>Aksi</th>

                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data as $idx=>$row) { ?>
                            <tr data-name="<?= $row->name; ?>" data-image="<?= $row->image; ?>" data-description="<?= $row->description; ?>" data-address="<?= $row->address; ?>" data-phone="<?= $row->phone; ?>" data-email="<?= $row->email; ?>" >
                                <td><?= ++$idx; ?></td>
                                <td><img src="<?= $row->image; ?>"></td>
                                <td><?= $row->name ?></td>
                                <td><button  onclick="return confirm('Apa anda yakin akan menghapus data ini ?')" data-url="" type="button" class="add btn btn-sm btn-danger"></i>Hapus</button></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    
    </div>
    <div class="col-sm-5 col-md-5 col-lg-5">
        <div class="card detail mb-4 mt-4" style="display:none">
            <div class="card-block">
                <div class="header">
                    <div class="mb-2" id="logo"></div>
                    <div id="name"></div>
                    <h6 class="card-subtitle mt-2 text-muted"></h6>
                </div>

                <div class="body border-top mb-2">
                    <div class="row">
                        <div class="col-md-4">Alamat</div>
                        <div class="col-md-8 text-right" id="address"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">No Kontak</div>
                        <div class="col-md-8 text-right" id="phone"></div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">Email</div>
                        <div class="col-md-8 text-right" id="email"></div>
                    </div>
                </div>
                
            </div>
        </div>
    </div> 
</section>