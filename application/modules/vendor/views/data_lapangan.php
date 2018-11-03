<section class="row">
    <div class="col-sm-8 col-md-8 col-lg-8">
   <div class="card">
       <div class="card-title data-table">
       <button  id="buttonAdd" data-url="<?= current_url() . '/add_form'  ?>" type="button" class="add btn btn-sm btn-primary"><i class="fa fa-plus"></i> Add Lapangan</button>
    
       </div>
        
        <div class="card-block">
            <table id="dataTable" class="table-striped dataTables dataLapangan" style="width:100%">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Lapangan / Gedung</th>
                        <th>Harga Sewa</th>
                        <td align="center">Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data as $idx=>$row) { ?>
                        <tr data-id='<?= $row->id ?>' data-name='<?= $row->name ?>' data-image='<?= $row->image ?>' >
                            <td><?= ++$idx; ?></td>
                            <td><?= $row->name; ?></td>
                            <td>Rp<?= $row->rent_price; ?></td>
                            <td>
                                <button  data-url="" type="button" class="add btn btn-sm btn-info"></i>Ubah</button>
                                <button  onclick="return confirm('Apa anda yakin akan menghapus data ini ?')" data-url="" type="button" class="add btn btn-sm btn-danger"></i>Hapus</button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
        
    </div>
    <div class="col-sm-4 col-md-4 col-lg-4">
        <div class="card detail mb-4 d-none">
            <div class="card-block">
                <h3 class="card-title">Jadwal</h3>
                <h6 class="card-subtitle mb-2 text-muted"></h6>
                <div class="schedules"></div>
            </div>
        </div>
    </div> 
</section>
